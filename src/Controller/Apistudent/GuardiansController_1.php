<?php
namespace App\Controller\Apistudent;

use App\Controller\Apistudent\AppController;
use Cake\Mailer\Email;

/**
 * Guardians Controller
 *
 * @property \App\Model\Table\GuardiansTable $Guardians
 */
class GuardiansController extends AppController
{
    
    
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }

    /**
     * Login
     */

    public function add(){
        $this->request->allowMethod(['post','put']);
        $d = $this->request->data;
        $check = $this->Guardians->find()->where([
            'email' => $d['email']
        ])->first();
        if($check){
            $result = [
                'error' => 1,
                'msg' => 'Email already exit'
            ];
        }else{
            $d['status'] = 1;
            $d['app_pwd'] = $d['password'];
            $d['is_app'] = 1;
            $this->Guardians->newEntity($d);
            if($this->Guardians->save($d)){
                $result = [
                    'error' => 0,
                    'msg' => 'Registration Done Successfully'
                ];
            }else{
                $result = [
                    'error' => 1,
                    'msg' => 'Something went wrong please try again'
                ];
            }
        }
        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }
    public function login() {
        \Cake\Core\Configure::write('debug',TRUE);
//        $d = $this->request->data;
//        $this->rq($d);
//        $this->request->allowMethod(['post', 'put']);
        $d['email'] = "ajayp944@gmail.com";
        $d['app_pwd'] = "sc4329";
        $d['device_token'] = "222";
        $guardians = $this->Guardians->find()->where([
                    'email' => $d['email'],
                    'app_pwd' => $d['app_pwd']
                ])
                ->contain(['Students'])

     // this will do the magic
    ->matching('Students')
//                ->contain([
//                    'Students' => function($q){
//                        return $q->select([
//                            'id','school_id','classroom_id','guardian_id','email','mobile', 'dob','first_name','last_name','image','session','address',
//                            'father_name', 'mother_name'
//                        ]);
//                    },
//                     'Students.Schools' => function($q){return $q->select(['name','image','session']);}
//                ])
                ->select([
                     'id','name','email','mobile','status','created'
                ])
                ->first();
        if ($guardians) {
                $this->Guardians->updateAll([
                        'device_token' => $d['device_token'],
                    ],
                    [
                        'id' => $guardians->id
                    ]);
            $result['result'] = $guardians;
        } else {
            $result['result'] = null;
        }
        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }

    public function changepwd($id = NULL){
        $guardians = $this->Guardians->get($id);
        $d = $this->request->data;
        $this->rq($d);
        if (!empty($d)) {
            if($guardians->app_pwd!=$d['old_password']){
                $result['error'] = 1;
                $result['msg'] = "old password doesn't match ";
            }else{
                if($d['password1'] != $d['password2']){
                    $result['error'] = 1;
                    $result['msg'] = "The passwords does not match!";
                }else{
                    $d['password'] = $d['password1'];
                    $d['app_pwd'] = $d['password1'];
                    $guardians = $this->Guardians->patchEntity($guardians, $d);
                    if ($this->Guardians->save($guardians)) {
                        $result['error'] = 0;
                        $result['msg'] = "The password has been changed successfully";
                    } else {
                        $result['error'] = 1;
                        $result['msg'] = "There was an error during the save!";
                    }
                }
            }
        }
        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }

    public function forgetpwd(){
        $this->request->allowMethod(['post','put']);
        $d = $this->request->data;
        $checkTeacher = $this->Guardians->find()->where(['email' => $d['email']])->count();
        if($checkTeacher){
            $newpassword = "sc".  rand(1000, 10000);
            $password = (new \Cake\Auth\DefaultPasswordHasher)->hash($newpassword);
            $this->Guardians->updateAll(['password'=> $password,'app_pwd' => $newpassword], ['email' => $d['email']]);
            $email = new Email('default');
            $email->from(['ajayp944@gmail.com' => 'School Club'])->to($d['email'])->subject('Forget Password')->send($newpassword);
            $result['error'] = 0;
            $result['msg'] = "New password has been send your registered Email. Please check your email";
        }else{
            $result['error'] = 1;
            $result['msg'] = "Eamil doesn't exit. Please enter registered email";
        }
        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }
}
