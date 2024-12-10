<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Log;

class Payments extends Controller
{
    public function buyOne($id)
    {
        $userId = Auth::id();
        $product = Producto::with('usuarios')->find($id);
        $creatorId = $product->usuarios->first()->id ?? null;

        $paypal = new PayPalClient();
        $paypal->setApiCredentials(config('paypal'));
        $paypal->getAccessToken();

        $response = $paypal->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $product->price,
                        "breakdown" => [
                            "item_total" => [
                                "currency_code" => "USD",
                                "value" => $product->price
                            ]
                        ]
                    ],
                    "items" => [
                        [
                            "name" => $product->name,
                            "quantity" => 1,
                            "unit_amount" => [
                                "currency_code" => "USD",
                                "value" => $product->price
                            ],
                            "description" => substr($product->description, 0, 127),
                            "category" => "PHYSICAL_GOODS"
                        ]
                    ]
                ]
            ],
            "payment_source" => [
                "paypal" => [
                    "experience_context" => [
                        "return_url" => route('shop.createReceipt', ['productId' => $id, 'userId' => $userId, 'creatorId' => $creatorId]),
                        "cancel_url" => route('shop.index'),
                        "brand_name" => "WellWoman",
                        "landing_page" => "LOGIN",
                        "user_action" => "PAY_NOW",
                        "shipping_preference" => "NO_SHIPPING"
                    ]
                ]
            ]
        ]);

        if (isset($response['id'])) {
            if ($response['status'] == 'CREATED' || $response['status'] == 'PAYER_ACTION_REQUIRED') {
                foreach ($response['links'] as $link) {
                    if ($link['rel'] == 'payer-action' || $link['rel'] == 'approve') {
                        return redirect()->away($link['href']);
                    }
                }
            }
        }
    }

    public function buyMany()
    {
        $user = Auth::user();
        $carrito = $user->carrito()->wherePivot('is_in_cart', true)->get();

        $totalPrice = $carrito->sum(function ($product) {
            return $product->pivot->quantity * $product->price;
        });

        $paypal = new PayPalClient();
        $paypal->setApiCredentials(config('paypal'));
        $paypal->getAccessToken();

        $response = $paypal->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $totalPrice,
                        "breakdown" => [
                            "item_total" => [
                                "currency_code" => "USD",
                                "value" => $totalPrice
                            ]
                        ]
                    ],
                    "items" => $carrito->map(function ($product) {
                        return [
                            "name" => $product->name,
                            "quantity" => $product->pivot->quantity,
                            "unit_amount" => [
                                "currency_code" => "USD",
                                "value" => $product->price
                            ],
                            "description" => substr($product->description, 0, 127),
                            "category" => "PHYSICAL_GOODS"
                        ];
                    })->toArray(),
                ]
            ],
            "payment_source" => [
                "paypal" => [
                    "experience_context" => [
                        "return_url" => route('shop.createReceiptMany'),
                        "cancel_url" => route('shop.index'),
                        "brand_name" => "WellWoman",
                        "landing_page" => "LOGIN",
                        "user_action" => "PAY_NOW",
                        "shipping_preference" => "NO_SHIPPING"
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && ($response['status'] == 'CREATED' || $response['status'] == 'PAYER_ACTION_REQUIRED')) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'payer-action' || $link['rel'] == 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }
    }

    public function createReceipt($productId, $userId, $creatorId)
    {
        $product = Producto::find($productId);
        $token = request('token');

        $paypal = new PayPalClient();
        $paypal->setApiCredentials(config('paypal'));
        $paypal->getAccessToken();

        $response = $paypal->capturePaymentOrder($token);

        if (isset($response['error']['name']) && $response['error']['name'] == 'UNPROCESSABLE_ENTITY') {
            foreach ($response['error']['links'] as $link) {
                if ($link['rel'] == 'redirect') {
                    return redirect()->away($link['href']);
                }
            }
        }

        if ($response['status'] == 'COMPLETED') {
            $factura = Factura::create([
                'purchase_date' => now(),
                'subtotal' => $product->price,
                'total' => $product->price,
                'buyer_id' => $userId,
                'creator_id' => $creatorId,
            ]);

            $factura->productos()->attach($productId, [
                'quantity' => 1,
                'price' => $product->price,
            ]);

            $product->decrement('stock', 1);

            return redirect()->route('shop.viewReceipt', ['factura' => $factura->id]);
        }
    }

    public function createReceiptMany()
    {
        $paypal = new PayPalClient();
        $paypal->setApiCredentials(config('paypal'));
        $paypal->getAccessToken();
        $orderId = request('token');

        $order = $paypal->capturePaymentOrder($orderId);

        if (isset($order['error']['name']) && $order['error']['name'] == 'UNPROCESSABLE_ENTITY') {
            foreach ($order['error']['links'] as $link) {
                if ($link['rel'] == 'redirect') {
                    return redirect()->away($link['href']);
                }
            }
        }

        if ($order['status'] == 'COMPLETED') {
            $orderDetails = $paypal->showOrderDetails($orderId);

            $userId = Auth::id();
            $user = Auth::user();

            $items = $orderDetails['purchase_units'][0]['items'] ?? [];
            $firstProduct = Producto::where('name', $items[0]['name'])->first();
            $creatorId = $firstProduct->usuarios()->first()->id ?? null;

            $factura = Factura::create([
                'purchase_date' => now(),
                'subtotal' => (int) $orderDetails['purchase_units'][0]['amount']['breakdown']['item_total']['value'],
                'total' => (int) $orderDetails['purchase_units'][0]['amount']['value'],
                'buyer_id' => $userId,
                'creator_id' => $creatorId,
            ]);

            foreach ($items as $item) {
                $product = Producto::where('name', $item['name'])->first();

                if ($product) {
                    $factura->productos()->attach($product->id, [
                        'quantity' => $item['quantity'],
                        'price' => (int) $item['unit_amount']['value'],
                    ]);
                }
            }

            $user->carrito()->detach();

            return redirect()->route('shop.viewReceipt', ['factura' => $factura->id]);
        }
    }

    public function viewReceipt(Request $rqs)
    {
        $pageId = "receiptPage";
        $facturaId = $rqs->query('factura');
        $factura = Factura::with('productos')->find($facturaId);

        return view('products.receipt', ['factura' => $factura, 'pageId' => $pageId]);
    }
}
