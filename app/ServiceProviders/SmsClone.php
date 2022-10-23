<?php

namespace App\ServiceProviders;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client as GuzzleClient; //Use as alias


class SmsClone {

    public function __construct(){

        $this->username = env('SMSCLONE_USERNAME');
        $this->password = env('SMSCLONE_PASSWORD');
        $this->sender = env('SMSCLONE_SENDER_ID');
        $this->sms_url = env('SMSCLONE_URL');
        

   }


    public function sendSMS($phone_number, $message) {

      

       $endpoint = $this->sms_url.'sendsms?username='.$this->username.'&password='.$this->password.'&sender='.$this->sender.'&recipient='.$phone_number.'&message='.urlencode($message);
        //$endpoint = `{$this->sms_url}?username={$this->username}&password={$this->password}&sender={$this->sender}&recipient={$phone_number}&message={$message}`;

        //Opition 1 - Curl
        
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $endpoint);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


        //OR
        // curl_setopt_array($ch, array(
        //     CURLOPT_URL => $endpoint,
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 30,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "POST",
        //     CURLOPT_HTTPHEADER => array(
        //         "cache-control: no-cache"
        //     ),
        // ));

        // $output = curl_exec($ch);
        // curl_close($ch);

        // dd($output);


        //Option 2 - Use a packgae - Guzzle in this case


        // try {

        //     $http = new GuzzleClient;

        //     $response = $http->request('GET', $endpoint);
    
        //     dd($response->getBody()->getContents());

        // }catch(\Exception $e) {

        //     dd($e->getMessage());
        // }


        //Option 3 - Use HTTP facade

        $response = Http::get($endpoint);

        $output = $response->body();

        if(!empty($output)) {

            if(str_contains($output, 'TG00')) {

                $data = [
                    'status' => 'success',
                    'message' => 'Message sent successfully'
                ];
            }else {

                $data = [
                    'status' => 'failed',
                    'message' => 'Message not sent'
                ];

            }
        }
        else {

            $data = [
                'status' => 'pending',
                'message' => 'Message is pending'
            ];
        }

        dd($data);
        return $data;





    }




}