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
        $recipients = "+254792107437,+254799638259";

        // Set your message
        $message    = "This is the message From George Kariuki. Link To end Another SMS https://comviva.georgekprojects.tk/sendSMS";

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
