<?php
namespace App\Controller\Apistudent;

use App\Controller\Apistudent\AppController;
use Cake\Mailer\Email;

/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 */
class StudentsController extends AppController
{
    
    
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }

    /**
     * Login
     */

    public function login() {
//        \Cake\Core\Configure::write('debug',TRUE);
        $this->request->allowMethod(['post', 'put']);
        
        $this->rq($this->request->data);
        $student = $this->Auth->identify();
        if ($student) {
            $this->Auth->setUser($student);
            $this->Students->updateAll([
                        'device_token' => $this->request->data['device_token'],
                        'deviceid' => $this->request->data['deviceid'],
                        'is_app' => $this->request->data['is_app'],
                        'app_type' => $this->request->data['app_type']
                    ],
                    [
                        'id' => $this->Auth->user('id')
                    ]);
            $studentsInfo = $this->Students->find()
                ->select([
                    'id','school_id','first_name','last_name','email','image','classroom_id','mobile','dob','session','address',
                    'father_name', 'mother_name'
                ])
                ->contain(['Schools' => function($q){return $q->select(['name','image','session']);}])
                ->where(['Students.id' => $this->Auth->user('id')])
                ->first();
            $result['result'] = $studentsInfo;
        } else {
            $result['result'] = null;
        }
        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Schools', 'Classrooms', 'Teachers', 'Guardians', 'Areas', 'Cities', 'States', 'Countries']
        ];
        $students = $this->paginate($this->Students);

        $this->set(compact('students'));
        $this->set('_serialize', ['students']);
    }

    /**
     * View method
     *
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $student  = $this->Students->find()
                ->contain([
                    'Schools','Classrooms'
                ])
                ->where(['id' => $id])
                ->first();
        $this->set('student', $student);
        $this->set('_serialize', ['student']);
    }
    public function changepwd($id = NULL){ 
        $student = $this->Students->get($id);
        $d = $this->request->data;
        $this->rq($d);
        if (!empty($this->request->data)) {
            $check = (new \Cake\Auth\DefaultPasswordHasher)->check($d['old_password'], $student->password);
            if(!$check){
                $result['error'] = 1;
                $result['msg'] = "old password doesn't match ";
            }else{
                if($d['password1'] != $d['password2']){
                    $result['error'] = 1;
                    $result['msg'] = "The passwords does not match!";
                }else{
                    $d['password'] = $d['password1'];
                    $d['aap_pwd'] = $d['password1'];
                    $student = $this->Students->patchEntity($student, $d);
                    if ($this->Students->save($student)) {
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
        $checkTeacher = $this->Students->find()->where(['email' => $d['email']])->count();
        if($checkTeacher){
            $newpassword = "sc".  rand(1000, 10000);
            $password = (new \Cake\Auth\DefaultPasswordHasher)->hash($newpassword);
            $this->Students->updateAll(['password'=> $password,'app_pwd'=> $newpassword], ['email' => $d['email']]);
            $email = new Email('default');
            $email->from(['ajayp944@gmail.com' => 'School Club'])->to($d['email'])->subject('Forget Password')->send($newpassword);
            $result['error'] = 0;
            $result['msg'] = "New password has been send your registered Email. Please check your email";
        }else{
            $result['error'] = 1;
            $result['msg'] = "Eamil doesn't exist. Please enter registered email";
        }
        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }
    
    public function isNoti(){
        $this->request->allowMethod(['post','put']);
        $d =  $this->request->data;
        $this->rq($d);
        $result = [
            'error' => 1,
            'msg' => 'Something went wrong please try again',
        ];
        $update = $this->Students->updateAll(['is_noty' => $d['is_noty']],['id' =>$d['id']]);
        if($update){
            if($d['is_noty']){
                 $message = "Notification on successfully";
            }else{
                $message = "Notification off successfully";
            }
            $result = [
                'error' => 0,
                'msg' => $message,
            ];
        }
        $this->set(compact('result'));
        $this->set('_serialize','result');
    }
}
