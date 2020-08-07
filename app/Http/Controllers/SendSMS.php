<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;

class SendSMS extends Controller
{
    //
    // ! send SMS. 

    public function sendSMS(){
        // Set your app credentials
        // return "Send Message Method";
        $username   = "SampleAppForMe";
        $apiKey     = "79ef469520d71bf5334224f6f7c23e4441e635f2728067289dcb2172e908be3d";

        // Initialize the SDK
        $AT         = new AfricasTalking($username, $apiKey);

        // Get the SMS service
        $sms        = $AT->sms();

        // Set the numbers you want to send to in international format
        $recipients = "+254792107437";

        // Set your message
        $message    = "I'm a lumberjack and its ok, I sleep all night and I work all day";

        // Set your shortCode or senderId
        // $from       = "MrInsurance";            

        try {
            //code...
            $result = $sms->send([
                'to'      => $recipients,
                'message' => $message,
                // 'from'    => $from
            ]);
        } catch (Exception $e) {
            echo "Error: ".$e->getMessage();
        }
}
}
