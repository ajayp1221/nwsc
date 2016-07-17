<?php
namespace App\Controller\Apiteacher;

use App\Controller\Apiteacher\AppController;

/**
 * Schools Controller
 *
 * @property \App\Model\Table\SchoolsTable $Schools
 */
class SchoolsController extends AppController
{
    /**
     * Login method
     */
    
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }
    
    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $result['error'] = 0;
                $result['msg'] = "Logged in successfully";
                $result['result'] = $this->Auth->user();
            } else {
                $result['error'] = 1;
                $result['msg'] = "Something went wrong please try again";
                $result['result'] = "";
            }
        }
        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }
    
    public function view(){
//        $teacherId = $this->request->header('teacher-id');
        $teacherId = 1;
        $result = $this->Schools->find()->hydrate(false)->where(['id' => $teacherId])->first();
        if($result){
            $result['error'] = 0;
            $result['msg'] = "sussess";
        }else{
            $result['error'] = 1;
            $result['msg'] = "Something went wrong please try again";
        }
        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }
}
