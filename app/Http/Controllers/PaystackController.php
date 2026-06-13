<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaystackController extends Controller
{
    /**
     * Verify a Paystack transaction and save the order to the database.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'reference' => 'required|string',
        ]);

        $secretKey = config('services.paystack.secret_key');

        if (! $secretKey) {
            return response()->json(['status' => 'error', 'message' => 'Paystack not configured'], 500);
        }

        try {
            $response = Http::withToken($secretKey)
                ->get("https://api.paystack.co/transaction/verify/{$request->reference}");

            $data = $response->json();

            if ($data['status'] && $data['data']['status'] === 'success') {
                $txn = $data['data'];
                $meta = $txn['metadata'] ?? [];

                // Save order to database
                $order = Order::updateOrCreate(
                    ['reference' => $txn['reference']],
                    [
                        'customer_name'   => $meta['customer_name'] ?? ($request->customer_name ?? 'Unknown'),
                        'customer_email'  => $txn['customer']['email'] ?? null,
                        'customer_phone'  => $meta['phone'] ?? ($request->phone ?? null),
                        'product_name'    => $meta['product_name'] ?? ($request->product_name ?? 'Unknown'),
                        'product_image'   => $meta['product_image'] ?? null,
                        'variant'         => $meta['variant'] ?? ($request->variant ?? null),
                        'size'            => $meta['size'] ?? ($request->size ?? null),
                        'amount'          => $txn['amount'] / 100,
                        'currency'        => $txn['currency'] ?? 'NGN',
                        'status'          => 'success',
                        'channel'         => $txn['channel'] ?? 'card',
                        'gateway_response'=> $txn['gateway_response'] ?? null,
                        'paid_at'         => $txn['paid_at'] ?? now(),
                        'paystack_data'   => $txn,
                    ]
                );

                Log::info('Paystack payment verified & saved', [
                    'order_id'  => $order->id,
                    'reference' => $txn['reference'],
                    'amount'    => $txn['amount'] / 100,
                ]);

                return response()->json([
                    'status'    => 'success',
                    'reference' => $txn['reference'],
                    'amount'    => $txn['amount'] / 100,
                ]);
            }

            // Save failed payment attempt too
            Order::updateOrCreate(
                ['reference' => $request->reference],
                [
                    'customer_name'    => $request->customer_name ?? 'Unknown',
                    'customer_email'   => $data['data']['customer']['email'] ?? null,
                    'product_name'     => $request->product_name ?? 'Unknown',
                    'amount'           => ($data['data']['amount'] ?? 0) / 100,
                    'currency'         => $data['data']['currency'] ?? 'NGN',
                    'status'           => 'failed',
                    'gateway_response' => $data['data']['gateway_response'] ?? 'Verification failed',
                    'paystack_data'    => $data['data'] ?? null,
                ]
            );

            return response()->json([
                'status'  => 'failed',
                'message' => $data['data']['gateway_response'] ?? 'Payment verification failed',
            ], 400);

        } catch (\Exception $e) {
            Log::error('Paystack verification error', ['error' => $e->getMessage()]);

            return response()->json([
                'status'  => 'error',
                'message' => 'Could not verify payment',
            ], 500);
        }
    }
}
