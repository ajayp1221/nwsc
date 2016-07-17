<?php
namespace App\Controller\Apistudent;

use App\Controller\Apistudent\AppController;
use Cake\Mailer\Email;

/**
 * Guardians Controller
 *
 * @property \App\Model\Table\GuardiansTable $Guardians
 * @property \App\Model\Table\CitiesTable $Cities
 * @property \App\Model\Table\SchoolsTable $Schools
 * @property \App\Model\Table\ClassroomsTable $Classrooms
 * @property \App\Model\Table\StudentsTable $Students
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
        $this->rq($d);
        $check = $this->Guardians->find()->where([
            'email' => $d['email']
        ])->first();
        if($check){
            $result = [
                'error' => 1,
                'msg' => 'Email already exist'
            ];
        }else{
            $d['status'] = 1;
            $d['app_pwd'] = $d['password'];
            $d['is_app'] = 1;
            $d = $this->Guardians->newEntity($d);
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
        \Cake\Core\Configure::write('debug',false);
//        $this->request->data['email'] = 'dharam0786@gmail.com';
//        $this->request->data['app_pwd'] = '123456';
        $d = $this->request->data;
        $this->rq($d);
        $this->request->allowMethod(['post', 'put']);
        $guardians = $this->Guardians->find()->where([
                    'email' => $d['email'],
                    'app_pwd' => $d['app_pwd']
                ])->contain([
                    'Students' => function($q){
                        return $q->select([
                            'id','school_id','classroom_id','email','mobile', 'dob','first_name','last_name','image','session','address',
                            'father_name', 'mother_name','guardian_mobile_1','guardian_mobile_2'
                        ]);
                    },
                    'Students.Schools' => function($q){return $q->select(['name','image','session']);}
                ])
                ->select([
                     'id','name','email','mobile','status','created'
                ])
                ->first();
        if ($guardians) {
                $this->Guardians->updateAll([
                        'device_token' => $d['device_token'],
                        'app_type' => $d['app_type'],
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
            $result['msg'] = "Eamil doesn't exist. Please enter registered email";
        }
        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }
    
    public function selectCity(){
        $this->request->allowMethod(['post','put']);
        $d = $this->request->data;
        $this->rq($d);
        $this->loadModel('Cities');
        $result = [
            'error' => 1,
            'msg' => 'no data found',
            'cities' => []
        ];
        $ctites = $this->Cities->find()->where([
            'name LIKE' => "%".$d['city_name']."%",
            'status' => 1
        ])->select(['id','name'])->toArray();
        if($ctites){
            $result = [
                'error' => 0,
                'msg' => 'success',
                'cities' => $ctites
            ];
        }
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
    public function selectSchool(){
//        \Cake\Core\Configure::write('debug',TRUE);
        $this->request->allowMethod(['post','put']);
//        $this->request->data['city_id'] = 1;
        $d = $this->request->data;
        $this->rq($d);
        $this->loadModel('Schools');
        $result = [
            'error' => 1,
            'msg' => 'no data found',
            'schools' => []
        ];
        $schools = $this->Schools->find()->hydrate(false)->where([
            'city_id' => $d['city_id'],
            'status' => 1
            
        ])->select(['id','name'])->toArray();
        if($schools){
            $result = [
                'error' => 0,
                'msg' => 'success',
                'schools' => $schools
            ];
        }
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
    public function selectClass(){
        $this->request->allowMethod(['post','put']);
        $d = $this->request->data;
        $this->rq($d);
        $this->loadModel('Classrooms');
        $result = [
            'error' => 1,
            'msg' => 'no data found',
            'classrooms' => []
        ];
        $classrooms = $this->Classrooms->find()->where([
            'school_id' => $d['school_id'],
        ])->select(['id','name','section'])->toArray();
        if($classrooms){
            $result = [
                'error' => 0,
                'msg' => 'success',
                'classrooms' => $classrooms
            ];
        }
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
    public function searchStudent(){
        \Cake\Core\Configure::write('debug',false);
        $this->request->allowMethod(['post','put']);
        $d = $this->request->data;
        $this->rq($d);
        $this->loadModel('Students');
        $studenid = json_decode($d['student_id'],true);
        $sId = ['0'];
        if($studenid['user_id']){
            foreach ($studenid['user_id'] as $stId){
                $sId[]= $stId['id'];
            }
        }
        $result = [
            'error' => 1,
            'msg' => 'no data found',
            'students' => []
        ];
        $students = $this->Students->find()->where([
            'classroom_id' => $d['classroom_id'],
            'id NOT IN' => $sId,
        ])->select(['id','first_name','last_name','image'])->orderAsc('first_name')->toArray();
        if($students){
            $result = [
                'error' => 0,
                'msg' => 'success',
                'students' => $students
            ];
        }
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
    
    public function selectChild(){
//        \Cake\Core\Configure::write('debug',true);
        $this->request->allowMethod(['post','put']);
//        $this->request->data['guardian_id'] = 1;
//        $studentId = $this->request->data['student_id'] = 2;
        $d = $this->request->data;
        $this->rq($d);
        $check = $this->Guardians->find()->matching('Students',function($q) use($studentId){
            return $q->where(['Students.id' => $studentId])->select(['id','school_id','classroom_id','email','mobile', 'dob','first_name',
                'last_name','image','session','address','father_name', 'mother_name','guardian_mobile_1','guardian_mobile_2']);
        })->where([
            'Guardians.id' => $d['guardian_id']
        ])->count();
        if($check){
            $result = [
                'error' => 1,
                'msg' => 'Child has been already selected',
                'students' => []
            ];
        }else{
            $selectStudent = $this->Guardians->get($d['guardian_id']);
            $data = [
                'name' => $selectStudent->name,
                'guardians_students' => [[
                    'guardian_id' => $d['guardian_id'],
                    'student_id' => $d['student_id']]
                ]
            ];
            $selectStudent = $this->Guardians->patchEntity($selectStudent, $data,['associated' => 'GuardiansStudents']);
            $this->Guardians->save($selectStudent);
            $guardians = $this->Guardians->find()->where([
                    'id' => $d['guardian_id']
                ])->contain([
                    'Students' => function($q){
                        return $q->select([
                            'id','school_id','classroom_id','email','mobile', 'dob','first_name','last_name','image','session','address',
                            'father_name', 'mother_name','guardian_mobile_1','guardian_mobile_2'
                        ]);
                    },
                    'Students.Schools' => function($q){return $q->select(['name','image','session']);}
                ])
                ->select([
                     'id','name','email','mobile','status','created'
                ])
                ->first();
            $result = [
                'error' => 0,
                'msg' => 'Child has been selected successfully',
                'students' => $guardians->students
            ];
        }
        $this->set(compact('result'));
        $this->set('_serialize','result');
    }
    
    public function removeChild(){
        $this->request->allowMethod(['post','put']);
        $d = $this->request->data;
        $guardian_id = $d['guardian_id'];
        $student_id = $d['student_id'];
        $conn = \Cake\Datasource\ConnectionManager::get('default');
        $checkExit = $conn->query("select `id` from `guardians_students` where `guardian_id` = $guardian_id  and student_id = $student_id");
        if($checkExit){
            $removeChild  = $conn->query("delete from `guardians_students` where `guardian_id` = $guardian_id  and student_id = $student_id");
            $result = [
                'error' => 0,
                'msg' => 'Child has been removed successfully',
            ];
            
        }else{
            $result = [
                'error' => 1,
                'msg' => 'something went wrong please try again',
            ];
        }
        $this->set(compact('result'));
        $this->set('_serialize','result');
    }
    
    
    public function isNoti(){
        $this->request->allowMethod(['post','put']);
        $d =  $this->request->data;
        $this->rq($d);
        $result = [
            'error' => 1,
            'msg' => 'Something went wrong please try again',
        ];
        $update = $this->Guardians->updateAll(['is_noti' => $d['is_noti']],['id' =>$d['id']]);
        if($update){
            if($d['is_noti']){
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