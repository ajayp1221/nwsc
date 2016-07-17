<?php
namespace App\Controller\Teacher;

use App\Controller\Teacher\AppController;

/**
 * Teachers Controller
 *
 * @property \App\Model\Table\TeachersTable $Teachers
 */
class TeachersController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow('login');
    }
    /**
     * Login method
     */
    
    public function index()
    {
        $teacher = $this->Teachers->find()
                ->contain([
                    'Areas' => function($q){return $q->select(['id','name']);},
                    'Cities' => function($q){return $q->select(['id','name']);},
                    'States' => function($q){return $q->select(['id','name']);},
                    'Countries' => function($q){return $q->select(['id','name']);},
                    'Schools' => function($q){return $q->select(['id','name']);}
                 ])
                ->where(['Teachers.id' => $this->Auth->user('id')])->first();
        $this->set(compact(['teacher']));
        $this->set('_serialize', 'teacher');
    }
    public function login() {
        $this->viewBuilder()->layout('login');
        if ($this->request->is('post')) {
            $teacher = $this->Auth->identify();
            if ($teacher) {
                $this->Auth->setUser($teacher);
                if ($this->request->data['remember'] == "1") {
                    $cookie = array();
                    $cookie['email'] = $this->request->data['email'];
                    $cookie['password'] = $this->request->data['password'];
                    $this->Cookie->write('remember', $cookie, true, "1 week");
                    unset($this->request->data['remember']);
                }
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('Username or password is incorrect'));
            }
        } else {
            if (($this->Cookie->read('remember'))) {
                $this->request->data = $this->Cookie->read('remember');
                $teacher = $this->Auth->identify();
                if ($teacher) {
                    $this->Auth->setUser($teacher);
                    return $this->redirect($this->Auth->redirectUrl());
                } else {
//                    $this->Cookie->destroy('remember');
                    $this->Flash->success('Invalid cookie');
//                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
        }
    }
    
    /**
     * Logout method
     */
    public function logout()
    {
        $this->Auth->logout();
        $this->Cookie->delete('remember');
        return $this->redirect(['controller' => 'teachers','action' => 'login']);
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
    
    public function edit($slug = null)
    {
        $teacher = $this->Teachers->findBySlug($slug)->contain(['Classrooms'])->firstOrFail();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $teacher = $this->Teachers->patchEntity($teacher, $this->request->data);
            if ($this->Teachers->save($teacher)) {
                $this->Flash->success(__('The teacher has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The teacher could not be saved. Please, try again.'));
            }
        }
        $schools = $this->Teachers->Schools->find('list', ['limit' => 200]);
        $areas = $this->Teachers->Areas->find('list', ['limit' => 200]);
        $cities = $this->Teachers->Cities->find('list', ['limit' => 200]);
        $states = $this->Teachers->States->find('list', ['limit' => 200]);
        $countries = $this->Teachers->Countries->find('list', ['limit' => 200]);
        $classrooms = $this->Teachers->Classrooms->find('list', ['limit' => 200]);
        $this->set(compact('teacher', 'schools', 'areas', 'cities', 'states', 'countries', 'classrooms'));
        $this->set('_serialize', ['teacher']);
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
                    $teacher = $this->Teachers->patchEntity($teacher, $this->request->data);
                    if ($this->Teachers->save($teacher)) {
                        $this->Flash->success(__('The password has been changed successfully'));
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->success(__('There was an error during the save!'));
                    }
                }
            }
        }
        $this->set(compact('teacher'));
        $this->set('_serialize', 'teacher');
    }

    public function forgetpwd(){
        $this->request->allowMethod(['post','put']);
        $d = $this->request->data;
        $checkTeacher = $this->Teachers->find()->where(['email' => $d['email']])->count();
        if($checkTeacher){
            $newpassword = "SC".  rand(1000, 10000);
            $password = (new \Cake\Auth\DefaultPasswordHasher)->hash($newpassword);
            $this->Teachers->updateAll(['app_pwd' => $newpassword,'password'=> $password], ['email' => $d['email']]);
            $email = new Email('default');
            $email->from(['ajayp944@gmail.com' => 'School Club'])->to($d['email'])->subject('Reset Password')->send($newpassword);
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
