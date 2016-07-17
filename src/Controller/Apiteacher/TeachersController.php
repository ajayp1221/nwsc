<?php
namespace App\Controller\Apiteacher;

use App\Controller\Apiteacher\AppController;
use Cake\Mailer\Email;

/**
 * Teachers Controller
 *
 * @property \App\Model\Table\TeachersTable $Teachers
 * @property \App\Model\Table\MobilelocalsTable $Mobilelocals
 * @property \App\Model\Table\ClassroomsTable $Classrooms
 */
class TeachersController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }

    /**
     * Login method
     */
    
    public function login() {
        \Cake\Core\Configure::write('debug',false);
        $this->request->allowMethod(['put','post']);
//        $this->request->data['device_token'] = "123456";
//        $this->request->data['deviceid'] = "123456";
//        $this->request->data['email'] = "ajayp944@gmail.com";
//        $this->request->data['password'] = "123456";
        $this->rq($this->request->data);
        $teacher = $this->Auth->identify();
        if ($teacher) {
            $this->Auth->setUser($teacher);
            $this->Teachers->updateAll([
                        'device_token' => $this->request->data['device_token'],
                        'deviceid' => $this->request->data['deviceid'],
                        'is_app' => $this->request->data['is_app'],
                        'app_type' => $this->request->data['app_type']
                    ],
                    [
                        'id' => $this->Auth->user('id')
                    ]);
            $this->loadModel('Mobilelocals');
            $this->Mobilelocals->deleteAll(['deviceid' => $this->request->data['deviceid']]);
            $teacherInfo = $this->Teachers->find()
                ->select(['id','school_id','first_name','last_name','email','image','dob','gender','mobile'])
                ->contain(['Schools' => function($q){return $q->select(['name','image','session']);}])
                ->where(['Teachers.id' => $this->Auth->user('id')])
                ->first();
            
            $this->loadModel('Classrooms');
            $classrooms = $this->Classrooms->find()->where([
                'school_id' => $teacherInfo->school_id
            ])->select([
                'id','school_id'
            ])->toArray();
            foreach($classrooms as $classroom){
                $data1 = [
                    'school_id' => $teacherInfo->school_id,
                    'classroom_id' => $classroom->id,
                    'model_name' => 'Students',
                    'value' => 1,
                    'deviceid' => $this->request->data['deviceid']
                ];
                $mobLoclSv = $this->Mobilelocals->newEntity($data1);
                $this->Mobilelocals->save($mobLoclSv);
                
            }
            $data = [
                [
                    'school_id' => $teacherInfo->school_id,
                    'model_name' => 'Classrooms',
                    'value' => 1,
                    'deviceid' => $this->request->data['deviceid']
                ],
                [
                    'school_id' => $teacherInfo->school_id,
                    'model_name' => 'Resultcatgories',
                    'value' => 1,
                    'deviceid' => $this->request->data['deviceid']
                ],

                [
                    'school_id' => $teacherInfo->school_id,
                    'model_name' => 'Timetables',
                    'value' => 1,
                    'deviceid' => $this->request->data['deviceid']
                ],
                [
                    'school_id' => $teacherInfo->school_id,
                    'model_name' => 'Subjects',
                    'value' => 1,
                    'deviceid' => $this->request->data['deviceid']
                ],
            ];
            $mobLoclEnties = $this->Mobilelocals->newEntities($data);
            foreach($mobLoclEnties as $mobLoclEnty){
                $this->Mobilelocals->save($mobLoclEnty);
            }
            $result['result'] = $teacherInfo;
        } else {
            $result['result'] = null;
        }
        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }
    
    public function view(){
//        $teacherId = $this->request->header('teacher-id');
        $teacherId = 1;
        $result = $this->Teachers->find()->hydrate(false)->where(['id' => $teacherId])->first();
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
    
    public function edit($id = null)
    {
        $teacher = $this->Teachers->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->rq($this->request->data);
            $teacher = $this->Teachers->patchEntity($teacher, $this->request->data);
            if ($this->Teachers->save($teacher)) {
                $result['error'] = 0;
                $result['msg'] = "Update successfully";
            } else {
                $result['error'] = 1;
                $result['msg'] = "Sorry something went wrong please try again";
            }
        }
        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }
    
    
    public function changepwd($id = NULL){
        $teacher = $this->Teachers->get($id);
        if (!empty($this->request->data)) {
            $check = (new \Cake\Auth\DefaultPasswordHasher)->check($this->request->data['old_password'], $teacher->password);
            if(!$check){
                $result['error'] = 1;
                $result['msg'] = "old password doesn't match ";
            }else{
                if($this->request->data['password1'] != $this->request->data['password2']){
                    $result['error'] = 1;
                    $result['msg'] = "The passwords does not match!";
                }else{
                    $this->request->data['password'] = $this->request->data['password1'];
                    $this->request->data['app_pwd'] = $this->request->data['password1'];
                    $teacher = $this->Teachers->patchEntity($teacher, $this->request->data);
                    if ($this->Teachers->save($teacher)) {
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
        $this->request->allowMethod(['put','post']);
//        $this->request->data['email'] = 'ajayp944@gmail.com';
        $d = $this->request->data;
        $this->rq($d);
        $checkTeacher = $this->Teachers->find()->where(['email' => $d['email']])->count();
        if($checkTeacher){
            $newpassword = "sc".  rand(1000, 10000);
//            $newpassword = 123456;
            $password = (new \Cake\Auth\DefaultPasswordHasher)->hash($newpassword);
            $this->Teachers->updateAll(['password'=> $password,'app_pwd' => $newpassword], ['email' => $d['email']]);
            $email = new Email('default');
            $email->from(['ajayp944@gmail.com' => 'School Club'])->to($d['email'])->subject('Reset Password')->send($newpassword);
            $result['error'] = 0;
            $result['msg'] = "New password has been send your registered Email. Please check your email";
        }else{
            $result['error'] = 1;
            $result['msg'] = "Eamil doesn't exist. Please enter registered email";
        }
        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }
}
