<?php
namespace App\Common;
class Methods {
    
    
    /**
     * Method to send Sms
     */
    
    
    public function smslogs($schoolId = null,$modelName = null,$modelId = null, $message=null,$logsModel=null,$logsModelId=null,$mobile= null){
//        \Cake\Core\Configure::write('debug',false);
        $mesglgTbl = \Cake\ORM\TableRegistry::get('Messagelogs');
        $d['school_id'] = $schoolId;
        $d['model_name'] = $modelName;
        $d['modelid'] = $modelId;
        $d['message'] = $message;
        $response = $this->plivoSms("+91".$mobile,$message);
        $apiResponse = json_encode($response);
        $d['messagesmslogs'] = [
            [
                "model_name" => $logsModel,
                "modelid" => $logsModelId,
                "mobile_number" => $mobile,
                "api_response" => $apiResponse
            ]
        ];
        $d = $mesglgTbl->newEntity($d);
        $mesglgTbl->save($d);
        debug($response);
        return $response;
    }
    
    /**
     * Method to send Pust Notification Android/Ios
     */
    
    public function appnotylogs($schoolId = null,$modelName = null,$modelId = null, $message=null,$logsModel=null,$logsModelId=null,$deviceToken= null,$apiKey=null,$appType="android",$is_noti=1){
//        \Cake\Core\Configure::write('debug',false);
        
        $mesglgTbl = \Cake\ORM\TableRegistry::get('Notificationlogs');
        $d['school_id'] = $schoolId;
        $d['model_name'] = $modelName;
        $d['modelid'] = $modelId;
        $d['message'] = $message;
        if($is_noti){
            if($appType=="ios"){

            }else{
                $response = $this->gcmNotification($deviceToken,$message,$apiKey);
                $apiResponse = json_encode($response);
            }
        }else{
            $apiResponse = "no response";
        }
        $d['notificationapplogs'] = [
            [
                "$logsModel" => $logsModelId,
                "api_response" => $apiResponse
            ]
        ];

        $d = $mesglgTbl->newEntity($d);
        $dd = $mesglgTbl->save($d);
        return TRUE;
    }





    public function gcmNotification($diviceid=null,$message=null,$apiKey = null) {
        
        $registrationIDs = array($diviceid);
        $msg = [ 
                    'message'   => $message
                ];
        $url = 'https://android.googleapis.com/gcm/send';
        $fields = array(
            'registration_ids' => $registrationIDs,
            'data' => $msg,
        );
        $headers = array(
            'Authorization: key=' . $apiKey,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    
    /**
     * Method to send SMS via Plivo
     * @param integer $contactno
     * @param stringer $message
     * @return Array[]
     */
    
    public function plivoSms($contactno=null,$message = null){
        $senderid = "SchoolClub";
        require_once(ROOT . DS . 'webroot' . DS . 'plivo.php');
        $auth_id = "MAYTDMODIYM2IWMJI2MW";
        $auth_token = "YmQ0ZjQ5ZDk2ZjYyNTFhZDg2YjZmODQyYzcyNDZj";
        $p = new \RestAPI($auth_id, $auth_token);
        $params = array(
            'src' => $senderid, /* Sender's phone number with country code */
            'dst' => $contactno, /* receiver's phone number with country code */
            'text' => $message
        );
        $response = $p->send_message($params);
        
        $multiplier = "0";
        $response = $p->send_message($params);
        if ($response['status'] == 202) {
            $params = array('record_id' => $response['response']['message_uuid'][0]);
            $response = $p->get_message($params);
            $multiplier = @$response['response']['units'];
        }
        $response['multiplier'] = $multiplier;
        return $response;        
    }
}