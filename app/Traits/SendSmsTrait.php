<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait SendSmsTrait
{

    protected function getOtp(): int
    {
        return rand(100000, 999999);
    }

    public function sendMessage($phone, $message, $return = false)
    {
        if (!get_setting('sms_token') || !get_setting('sms_identity')) {
            showNotification('SMS credentials not set', 'error');
            return back()->send();
        }

        $args = http_build_query(array(
            'token' => get_setting('sms_token'),
            'from' => get_setting('sms_identity') ?? 'InfoAlert',
            'to' => $phone,
            'text' => $message));

        $url = get_setting('sms_api');

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    }
}
