<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Log;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        try {

            Log::info('=== MIDTRANS CALLBACK MASUK ===');
            Log::info($request->all());

            $serverKey = config('services.midtrans.serverKey');

            // VALIDASI SIGNATURE
            $signatureKey = hash(
                'sha512',
                $request->order_id .
                $request->status_code .
                $request->gross_amount .
                $serverKey
            );

            if ($signatureKey !== $request->signature_key) {

                Log::error('SIGNATURE INVALID');

                return response()->json([
                    'message' => 'Signature tidak valid'
                ], 403);
            }

            $orderId = $request->order_id;
            $transactionStatus = $request->transaction_status;

            Log::info([
                'ORDER_ID' => $orderId,
                'TRANSACTION_STATUS' => $transactionStatus,
            ]);

            // CARI DATA
            $pemesanans = Pemesanan::where('kode_transaksi', $orderId)->first();

            if (!$pemesanans) {

                Log::error('PEMESANAN TIDAK DITEMUKAN');

                return response()->json([
                    'message' => 'Pemesanan tidak ditemukan'
                ], 404);
            }

            Log::info([
                'STATUS_SEBELUM' => $pemesanans->status,
            ]);

            // =========================
            // LOGIC FIXED (INTI PERBAIKAN)
            // =========================

            if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {

                $pemesanans->status = 'dibayar';

            } elseif ($transactionStatus == 'pending') {

                $pemesanans->status = 'menunggu';

            } elseif (
                $transactionStatus == 'deny' ||
                $transactionStatus == 'expire' ||
                $transactionStatus == 'cancel'
            ) {

                $pemesanans->status = 'batal';
            }

            $pemesanans->save();

            Log::info([
                'STATUS_SESUDAH' => $pemesanans->status,
                'SAVE' => true
            ]);

            return response()->json([
                'message' => 'Callback berhasil'
            ]);

        } catch (\Exception $e) {

            Log::error('ERROR CALLBACK');
            Log::error($e->getMessage());

            return response()->json([
                'message' => 'ERROR CALLBACK',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}