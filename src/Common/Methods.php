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
        $response = $this->plivoSms($mobile,$message);
        $externalId = explode("| ", $response['gupshup_response']);
        $externalId = end($externalId);
        $apiResponse = json_encode($response['gupshup_response']);
        $d['messagesmslogs'] = [
            [
                "model_name" => $logsModel,
                "modelid" => $logsModelId,
                "mobile_number" => $mobile,
                "api_response" => $apiResponse,
                'externalid' => $externalId,
                'sms_charge' => $response['sms_charge']
            ]
        ];
        $d = $mesglgTbl->newEntity($d);
        $mesglgTbl->save($d);
        return $response;
    }
    
    /**
     * Method to send SMS via Plivo
     * @param integer $contactno
     * @param stringer $message
     * @return Array[]
     */
    
    
    
    public function detect($v = "") {
        $v = str_replace(" Optout sms OPTZKP to 9220092200", "", $v);
        
        
        $v = str_replace(array("\n", "\r\n", "\r"),"",$v);        
        $cnSrtCd = preg_match_all('/\\{\\{\\w+}}/i', $v);
        $v = preg_replace('/\\{\\{\\w+}}/i', "", $v);
        $unicodeCount = preg_match_all('/([\p{Devanagari}])/imu', $v);
        $res = [];
        $res['shortCodesCount'] = $cnSrtCd;
        $res['unicodeCount'] = $unicodeCount;
        $res['smsCharCount'] = (mb_strlen($v,'utf-8') + ($cnSrtCd * 15));
        $smsCount = 0;
        if($unicodeCount > 0){
            $smsCount = 1 + ceil(($res['smsCharCount'] - (70)) / 66);
            $res['smsType'] = "UNICODE_TEXT";
        }else{
            $smsCount = 1 + ceil(($res['smsCharCount'] - (160)) / 153);
            $res['smsType'] = "TEXT";
        }
        $res['smsCount'] = $smsCount;
        return $res;
    }
    public function plivoSms($contactno=null,$message = null,$mask="SCCLUB"){
        
        $request =""; //initialise the request variable
        $param["method"]= "sendMessage";
        $param["send_to"] = $contactno;
        $param["msg"] = $message;
        $param["userid"] = "2000160631";
        $param["password"] = "schoolsclub@2015";
        $param["mask"] = $mask;
        $param["v"] = "1.1";
        $r = $this->detect($message);
        $res['sms_charge'] = $r['smsCount'];
        $param["msg_type"] = $r['smsType']; //Can be "FLASHâ€�/"UNICODE_TEXT"/â€�BINARYâ€�
        $param["auth_scheme"] = "PLAIN";
        //Have to URL encode the values
        foreach($param as $key=>$val) {
            $request.= $key."=".urlencode($val);
            //we have to urlencode the values
            $request.= "&";
            //append the ampersand (&) sign after each parameter/value pair
        }
        $request = substr($request, 0, strlen($request)-1);
        //remove final (&) sign from the request
        $url =
        "http://enterprise.smsgupshup.com/GatewayAPI/rest?".$request;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res['gupshup_response'] = curl_exec($ch);
        curl_close($ch);
        return $res;
        
        
    }
    
    /**
     * Method to send Pust Notification Android/Ios
     */
    
    public function appnotylogs($schoolId = null,$modelName = null,$modelId = null, $message=null,$logsModel=null,$logsModelId=null,$deviceToken= null,$apiKey=null,$appType="android",$is_noti=1){
        \Cake\Core\Configure::write('debug',false);
        
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
    
    /**
     * Method to send Android Push Notification
     * @param stringer $message
     * @return Array[]
     */

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
}