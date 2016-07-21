<?php

namespace App\Controller\Teacher;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 * @property \App\Model\Table\StudentsTable $Students
 */

class AppController extends Controller
{

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie');
        $this->loadComponent('Auth',[
            'loginAction' => [
                'controller' => 'teachers',
                'action' => 'login'
            ],
            'logoutRedirect' => [
                'controller' => 'teachers',
                'action' => 'login'
            ],
            'authError' => 'Did you really think you are allowed to see that?',
            'authenticate' => [
                'Form' => [
                    'userModel' => 'Teachers',
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ]
                ]
            ]
        ]);
    }
    public function rq($data){
        ob_start();
        print_r($data);
        $c = ob_get_clean();
        $fc = fopen('rq.txt', 'w');
        fwrite($fc, $c);
        fclose($fc);
    }

    
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->loadModel('Teachers');
        $authuser = $this->Teachers->find()->where(['id'=>$this->Auth->user('id')])->first();
        $this->set('authuser',$authuser);
        $this->set('authTeacher',$authuser);
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
