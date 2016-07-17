<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
/**
 * Commons Controller
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
}
