<?php

namespace App\Service;


class HttpService
{
    public function get(string $url) : array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
        $result=curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

}