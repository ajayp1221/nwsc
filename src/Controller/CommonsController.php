<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
/**
 * Commons Controller
 *
 * @property \App\Model\Table\MessagesmslogsTable $Messagesmslogs
 */
class CommonsController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
    }
    
    public function noty($deviceId = null){
        $methods = new \App\Common\Methods();
        $result = $methods->gcmNotification(
            $deviceId,
            'Test Notification',
            $this->studentAppApikey
        );
        debug($result);exit;
    }

    public function contactUs(){
        \Cake\Core\Configure::write('debug',TRUE);
        $this->request->allowMethod(['post','put']);
        $d = $this->request->data;
        if(filter_var($d['email'],FILTER_VALIDATE_EMAIL)){
            $email = new Email('default');
            $message = '<b>Name - </b>'. $d['name']."<br/> ".$d['message'];
            $response = $email->from([$d['email'] => $d['name']])->to('ajayp944@gmail.com')->subject('Contact Us')->send($message);
            $result =  true;
        }else{
            $result =  false;
        }
        
        $this->set(compact($result));
        $this->set('_serialize','result');
    }
    
    public function gupshupResponse(){
        \Cake\Core\Configure::write('debug',false);
        $d = $this->request->query;
        $this->loadModel('Messagesmslogs');
        $gEnt = $this->Messagesmslogs->find()->where([
           "externalid" => $d['externalId']
        ])->first();
        if($gEnt){
            $gEnt->set('cause', $d['cause']);
            $gEnt->set("modified", time());
            if($messagesmsTbl->save($gEnt)){
                $result = [
                    'error' => 0,
                    'msg' => "gupshup response updated successfully"
                ];
            }else{
                $result = [
                    'error' => 1,
                    'msg' => "Something went wrong please try again"
                ];
            }
        }else{
            $result = [
                    'error' => 1,
                    'msg' => "No record found"
                ];
        }
        $this->set(compact('result'));
        $this->set('_serialize','result');
    }
    
     public function gupshupLog(){
        \Cake\Core\Configure::write('debug',true);
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '-1');
        $this->loadModel('Messagesmslogs');
        $date = date("Y-m-d");
        $prev_date = time() - 24*60*60;
        $messagesmslogs = $this->Messagesmslogs->find()->where(['created >' => $prev_date])->toArray();
        foreach($messagesmslogs as $r){
            $r1 = file_get_contents('http://enterprise.smsgupshup.com/custdlr/api/rest.php?accId=2000160631&password=schoolsclub@2015&causeId=' . $r->externalid);
            $r1 = json_decode($r1);
            if($r1[0]->status){
                $status = $r1[0]->status;
                $cause = $r1[0]->cause;
                $time = time();	
                if($msgEnt){
                    $this->Messagesmslogs->updateAll(['cause' => $cause,'modified' => $time], ['externalid' => $r['externalid']]);
                }
            }
        }
        exit;
    }
}
