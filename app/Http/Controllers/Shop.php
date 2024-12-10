<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImagesManager;

class Shop extends Controller
{
    public function index()
    {
        $pageId = 'shopPage';
        $productos = Producto::all();
        $categorias = $productos->pluck('category')->map(fn($categoria) => strtolower($categoria))->unique()->map(fn($categoria) => ucfirst($categoria));

        $user = Auth::user();
        $roles = $user ? $user->roles->pluck('type')->toArray() : ["Visitante"];
		
		if ($user) {
			$carrito = $user->carrito()->wherePivot('is_in_cart', true)->get();
			$totalCarrito = $carrito->count();
			
			if ($productos->isEmpty()) {
				return view("shop/index", ['productos' => $productos, 'noitems' => true, 'categorias' => $categorias, 'pageId' => $pageId, 'roles' => $roles]);
			}

			return view("shop.index", ['productos' => $productos, 'categorias' => $categorias, 'pageId' => $pageId, 'roles' => $roles, 'carrito' => $carrito, 'totalCart' => $totalCarrito]);	
		} else {
			if ($productos->isEmpty()) {
				return view("shop/index", ['productos' => $productos, 'noitems' => true, 'categorias' => $categorias, 'pageId' => $pageId, 'roles' => $roles]);
			}
			
			return view("shop.index", ['productos' => $productos, 'categorias' => $categorias, 'pageId' => $pageId, 'roles' => $roles]);
		}
    }

    public function additem(Request $rqs)
    {
        $imagePath = null;
        $user = Auth::user();

        if ($rqs->hasFile('image')) {
            $imagePath = ImagesManager::saveImgToDB($rqs);
        }
        ;

        $product = Producto::create([
            'name' => $rqs->input('name'),
            'description' => $rqs->input('description'),
            'price' => $rqs->input('price'),
            'stock' => $rqs->input('quantity'),
            'mark' => $rqs->input('brand'),
            'category' => $rqs->input('category'),
            'image_url' => $imagePath,
        ]);

        $user->pedidos()->attach($product->id);

        return redirect()->route("shop.index")->with('session_type', 'itemSaved');
    }

    public function removeItem($id)
    {
        $product = Producto::findOrFail($id);
        $product->delete();

        return redirect()->route('shop.index')->with('session_type', 'itemDeleted');
    }

    public function editItem(Request $rqs, $id)
    {
        $product = Producto::find($id);

        $imagePath = null;

        if ($rqs->input('image') != null && $rqs->hasFile('image')) {
            $imagePath = ImagesManager::saveImgToDB($rqs);
        }
        ;

        $oldPrice = $product->oldprice;

        if ($rqs->input('price') == $oldPrice) {
            $product->oldprice = 0;
        } else {
            $product->oldprice = $product->price;
        }
        ;

        $product->name = $rqs->input('name');
        $product->description = $rqs->input('description');
        $product->price = $rqs->input('price');
        $product->stock = $rqs->input('quantity');
        $product->category = $rqs->input('category');
        $product->mark = $rqs->input('brand');
        $product->image_url = (!$rqs->input('image')) ? $product->image_url : $imagePath;

        $product->save();

        return redirect()->route("shop.index")->with('session_type', 'itemEdited');
    }

    public function viewProduct($id)
    {
        $pageId = 'viewPage';

        $product = Producto::with('usuarios')->findOrFail($id);

        $user = $product->usuarios->first() ?? null;

        return view('products.index', ['product' => $product, 'pageId' => $pageId, 'userData' => $user]);
    }

    public function addToCart($id)
    {
        $user = Auth::user();

        $inCart = $user->carrito()->where('product_id', $id)->exists();

        if ($inCart) {
            $user->carrito()->updateExistingPivot($id, [
                'quantity' => DB::raw('quantity + 1'),
                'is_in_cart' => true
            ]);
        } else {
            $user->carrito()->attach($id, [
                'quantity' => 1,
                'is_in_cart' => true
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function removeToCart($id)
    {
        $user = Auth::user();

        $user->carrito()->detach($id);

        return response()->json(['success' => true]);
    }
}
