<?php

namespace app\ServiceProviders;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client as guzzleClient;

class Termii{


    public function __construct() {

        $this->api_key = env('TERMMI_API_KEY');


    }

    public function sendSMS($phone_number, $sms) {

        

        $endpoint = [

            'to' => $phone_number,
            'from' => 'Onecentral',
            'sms' => $sms,
            'type' => 'plain',
            'channel' => 'generic',
            "api_key" =>  $this->api_key,


        ];

        $jendpoint = $endpoint;


        $baseurl = 'https://api.ng.termii.com/api/sms/send';

        //Use Guzzle client


        $header = ['Content-Type' => 'application/json'];

        // $send = new guzzleClient();

        // $response = $send->post($baseurl, ['header' => $header, 'json' => $jendpoint]);

        // $theresponse = $response->getBody();

        // $aresponse = json_decode($theresponse, true);

        // return $aresponse['code'];


        //use HTTP client

        $send = Http::post($baseurl, $endpoint);
        $response = $send->body();

        $response = json_decode($response, true);

        //dd($response);

        if (isset($response['code'])) {

                if ($response['code'] == "ok") {

                    $data = [

                        "status" => "success",
                        "message" => "Message sent successfully",

                    ];
                }

                elseif (in_array($response['code'], [400, 401, 403 ,404])) {

                    $data = [

                        "status" => "failed",
                        "message" => "Message sent successfully",

                    ];

                }

                else {

                    $data = [

                        "status" => "pending",
                        "message" => "Message is pending",

                    ];
                }

        }else {

            $data = [

                "status" => "failed",
                "message" => "Message Failed",

            ];
        }

        return $data;


        


    }


}