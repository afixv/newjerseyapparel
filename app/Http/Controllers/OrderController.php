<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function sendMessage(Request $request)
    {
        $curl = curl_init();

        $phoneNumber = $request->input('no_telephone');
        $message = 'Hello, ' . $request->input('nama_user') . ' your order has been received. Thank you for shopping with us.';
        $countryCode = $request->input('country_code', '62');
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
