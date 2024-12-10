<?php
return [

    /**
     * You can generate API keys here: https://cloudconvert.com/dashboard/api/v2/keys.
     */

    'api_key' => env('CLOUDCONVERT_API_KEY', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOGFlYjEzODBkMzU2YTY1NWY5YjJhNGEzNGY0ODYyOTgxZDU1ZTJmNGUzMmJiNzVjYjNmOGZiZjE3YzBjNzBiNjYyYWE4YWE1YjM4NWQ3YWEiLCJpYXQiOjE3MzE5OTIzMTAuOTUwMDM2LCJuYmYiOjE3MzE5OTIzMTAuOTUwMDM3LCJleHAiOjQ4ODc2NjU5MTAuOTQ1NTM2LCJzdWIiOiI3MDI0NTUwOCIsInNjb3BlcyI6WyJ1c2VyLnJlYWQiLCJ1c2VyLndyaXRlIiwidGFzay5yZWFkIiwidGFzay53cml0ZSIsIndlYmhvb2sud3JpdGUiLCJ3ZWJob29rLnJlYWQiLCJwcmVzZXQucmVhZCIsInByZXNldC53cml0ZSJdfQ.Rgl7VuQERRcHcKVnioYeX8DIW0ALrEJm-Tyfl0svE6ChErYB9nYhwPV8mn9afcKDtXOWlp_3Gim5Mtyz3hWybyHizwPQo4b79j_Fvp_hW7yq0kBD9R77JqoXZCVehy-yyguIYbKMEpn7KuD99ZfXn2kNLWRBmmP1ChaSwTbTBYGhiqcbw5WmEjV4bxm_36FYqg_Ch_v-utXyiBfJ0pDQolw5csxj0u-SpGlAx2oArGNjfp2a0JGeCOTIygvANRH1yFWJhLle9WTJoojqv5VpXSnrCtet3cWCIuRHKOXKNjgCn9sCd-ZYJDoGkx_rWZbzFdZ54p-VGjPERHA0g-m27JV6_s3JXeXywWy2tmhPowpS1zuTrWvqs9d5iYmt2NLl7Ifzhm1w4NMx9xSjk0sspTa04iwNxCMKUlPn7_mjoWLHwX7QFrt9_ZJZ99BkmuNUtabqEZKHAv_aXc_9omlPWvzJUW8sUrPJBuula3E4zFRyDngHENTge4F_SvVxvX5R8sqUXoXD_l5cRRwYtmW3cTFk84GZ1EPB3tfyRmMaQr2nhPYpL5HMvWqMokRB5F1IJ6KEceKNN-QWDqzHgoc6L4r8u0p-RofgyREzBM9a_T4dmZiGDizSMlOn38rH_DJOeZBBG5dUHBiPVHa_gGF7Q2NkRKmzkaa9R0Yi6XmjcPg'),

    /**
     * Use the CloudConvert Sanbox API (Defaults to false, which enables the Production API).
     */
    'sandbox' => env('CLOUDCONVERT_SANDBOX', false),

    /**
     * You can find the secret used at the webhook settings: https://cloudconvert.com/dashboard/api/v2/webhooks
     */
    'webhook_signing_secret' => env('CLOUDCONVERT_WEBHOOK_SIGNING_SECRET', '')
];
