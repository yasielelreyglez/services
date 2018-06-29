<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Send_notification
{
    
    static public function send($device_id, $os, $notificacion)//$email_address,$emailLibrary
    {

        //send notification push
        $data = null;

        $headers = [
            'Authorization:key=AAAAKPbDrfY:APA91bGWAWMMyP4kIR9rk2poNB-c4FRdKt31T3COXR6-b7N5Nh3KijQvWHFgaGDFW6yWGB1NHL8xweDo03keoRfnq1nNRSZlm',
            'Content-Type: application/json'
        ];

        if ($os === 'IOS') {
            $data = [
                'to' => $device_id,
                'notification' => [
                    'body' => $notificacion['text'],
                    'title' => 'Información',
					"sound"=>"default",
					"click_action"=>"FCM_PLUGIN_ACTIVITY"
				],
//        ,
//        "data" => [// aditional data for iOS
//            "extra-key" => "extra-value,
//        ],
                'notId' => $notificacion['id']//unique id for each notification
            ];
        } elseif ($os === 'ANDROID') {
            $data = [
                'to' => $device_id,
                'notification' => [
                    'body' => $notificacion['text'],
                    'title' => 'Información',
					"sound"=>"default",
					"click_action"=>"FCM_PLUGIN_ACTIVITY"
				],
				"data" =>[
					"title" => "Información",
					'body' => $notificacion['text'],
					"sound"=>"default"
					
				]
            ];
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
        $result = curl_exec($ch);
        curl_close($ch);

        //send email
        //$emailLibrary->from('inis@inis.com', 'Inis Taxi');
        //$emailLibrary->to($email_address);
        //$emailLibrary->subject('Notificación enviada por el sistema Inis-Taxi');
        //$emailLibrary->message($not['text']." (".$not['reserv_code'].")");
        //$emailLibrary->send();
	}
	
	static public function sendDriverNotification(){
		$data = json_encode([
			"to" => '/topics/driverAlert',
			"notification" => [
				"title" => "Nueva Solicitud",
				'body' => 'Solicitud de Carrera',
				"sound"=>"default",
				"click_action"=>"FCM_PLUGIN_ACTIVITY"
			],
			"data" =>[
				"title" => "Nueva Solicitud",
				'body' => 'Solicitud de Carrera',
				"sound"=>"default"
				
			]
		]);
		//FCM API end-point
		$url = 'https://fcm.googleapis.com/fcm/send';
		//api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
		$server_key = 'AAAAKPbDrfY:-c4FRdKt31T3COXR6-b7N5Nh3KijQvWHFgaGDFW6yWGB1NHL8xweDo03keoRfnq1nNRSZlm';
		//header with content_type api key
		$headers = array(
			'Content-Type:application/json',
			'Authorization:key='.$server_key
		);
		//CURL request to route notification to FCM connection server (provided by Google)
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$result = curl_exec($ch);
		if ($result === FALSE) {
			die('Oops! FCM Send Error: ' . curl_error($ch));
		}
		curl_close($ch);
	}
}
