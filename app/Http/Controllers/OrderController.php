<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderService(Request $request, $id)
    {
        $request->validate([
            'nama_customer' => 'required',
            'no_hp' => 'required',
            'total_harga' => 'required',
            'jumlah_pesanan' => 'required',
            'keterangan' => 'required',
        ]);

        $order = Order::create([
            'nama_customer' => $request->nama_customer,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'total_harga' => $request->total_harga,
            'jumlah_pesanan' => $request->jumlah_pesanan,
            'keterangan' => $request->keterangan,
            'link_desain' => $request->link_desain,
            'request_desain' => $request->request_desain,
            'status' => 1,
        ]);

        $order->services()->attach($id);

        $message = '
        Hi Nama User,
        Terima kasih telah melakukan pemesanan di New Jersey Apparel.
        ========================================
        Berikut adalah rincian pesanan Anda:
        ID Pesanan: ' . $order->id . '
        Nama Layanan: ' . $order->services->first()->nama . '
        Nama Customer: ' . $request->nama_customer . '
        No HP: ' . $request->no_hp . '
        Alamat: ' . $request->alamat . '
        Total Harga: ' . $request->total_harga . '
        Jumlah Pesanan: ' . $request->jumlah_pesanan . '
        Keterangan: ' . $request->keterangan .
        '
        ========================================
        Silahkan lakukan pembayaran sebesar ' . $request->total_harga . ' ke rekening berikut:

        Bank: BCA
        Nomor Rekening: 1234567890 a.n. New Jersey Apparel

        atau dapat melakukan pembayaran cash di toko kami.

        Setelah melakukan pembayaran, harap konfirmasi dengan mengirimkan bukti pembayaran di sini.
        ========================================
        New Jersey Apparel
        Jl. Mayang, Gadungsari RT9/12 (depan SD Al-Mujahidin), Wonosari, Gunungkidul, Yogyakarta.
        089671608531
        ';

        $this->sendMessage($request, $message);

        return response()->json(['message' => 'Order created successfully.']);
    }

    public function updateStatus($id)
    {
        $order = Order::find($id);
        if($order->status < 6) {
            $order->status = $order->status + 1;
            $order->save();
        } else {
            return response()->json(['message' => 'Order status cannot be updated anymore.']);
        }

        // Notify that the order has been completed
        if($order->status == 6) {
            $message = '
            Hi Nama User,
            Pesanan Anda di New Jersey Apparel telah selesai.
            ========================================
            Terima kasih telah melakukan pemesanan di New Jersey Apparel.
            Pesanan Anda telah selesai dan siap untuk diambil.
            Silahkan datang ke toko kami untuk mengambil pesanan Anda atau menunggu untuk dikirim chat nomer ini untuk informasi lebih lanjut.
            ========================================
            New Jersey Apparel
            Jl. Mayang, Gadungsari RT9/12 (depan SD Al-Mujahidin), Wonosari, Gunungkidul, Yogyakarta.
            089671608531
            ';
            $this->sendMessage($order, $message);
        }

        // Give receipt and track order
        if($order->status == 2) {
            $message = '
            Hi Nama User,
            Terima kasih telah melakukan pembayaran untuk pesanan Anda di New Jersey Apparel.
            ========================================
            Pembayaran Anda telah kami terima dan pesanan anda masuk ke dalam antrian.
            Berikut adalah link untuk melacak pesanan Anda: newjerseyapparel.id/trackorder/4938532489

            Terima kasih atas kerjasamanya. Kami akan segera memproses pesanan Anda.
            ========================================
            New Jersey Apparel
            Jl. Mayang, Gadungsari RT9/12 (depan SD Al-Mujahidin), Wonosari, Gunungkidul, Yogyakarta.
            089671608531
            ';

            $this->sendMessage($order, $message);
        }

        return response()->json(['message' => 'Order status updated successfully.']);
    }

    public function rejectOrder(Request $request, $id)
    {
        $order = Order::find($id);
        $request->validate([
            'keterangan' => 'required',
        ]);

        if($order->status == 1) {
            $order->status = 0;
            $order->save();

            $message =
            'Hi *Nama User*,

            Pesanan anda telah ditolak dengan keterangan:

            _'. $request->keterangan . '_

            New Jersey Apparel
            Jl. Mayang, Gadungsari RT9/12 (depan SD Al-Mujahidin), Wonosari, Gunungkidul, Yogyakarta.
            089671608531';

            $this->sendMessage($order, $message);

            return response()->json(['message' => 'Order rejected successfully.']);
        } else {
            return response()->json(['message' => 'Order status tidak dapat ditolak.']);
        }
    }


    public function sendMessage($order, $message)
    {
        $curl = curl_init();

        $phoneNumber = $order->no_hp;
        $countryCode = '62';
        $caBundlePath = storage_path('certificates/cacert.pem');

        $postData = array(
            'target' => $phoneNumber,
            'message' => $message,
            'countryCode' => $countryCode,
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => array(
                'Authorization: 14J3419_qm2+P7U_BcF9'
            ),
            CURLOPT_CAINFO => $caBundlePath,
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
        curl_close($curl);

        if (isset($error_msg)) {
            return response()->json(['error' => $error_msg], 500);
        }

        return $response;
    }
}
