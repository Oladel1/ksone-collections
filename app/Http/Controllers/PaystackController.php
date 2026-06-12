<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaystackController extends Controller
{
    /**
     * Verify a Paystack transaction after client-side payment.
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

                Log::info('Paystack payment verified', [
                    'reference'  => $txn['reference'],
                    'amount'     => $txn['amount'] / 100,
                    'currency'   => $txn['currency'],
                    'email'      => $txn['customer']['email'] ?? null,
                    'name'       => $request->customer_name,
                    'phone'      => $request->phone,
                    'metadata'   => $txn['metadata'] ?? [],
                    'paid_at'    => $txn['paid_at'] ?? null,
                ]);

                return response()->json([
                    'status'    => 'success',
                    'reference' => $txn['reference'],
                    'amount'    => $txn['amount'] / 100,
                ]);
            }

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
