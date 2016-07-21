<?php
namespace App\Controller\Teacher;

use App\Controller\Teacher\AppController;

/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 * @property \App\Model\Table\SubjectsTable $Subjects
 * @property \App\Model\Table\ResultcategoriesTable $Resultcategories
 * @property \App\Model\Table\MobilelocalsTable $Mobilelocals
 * @property \App\Model\Table\SettingsTable $Settings
 * @property \App\Model\Table\SchoolfeesTable $Schoolfees
 * @property \App\Model\Table\SchoolfeesTable $Schoolbusfees
 */
class StudentsController extends AppController
{


    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($cSlug = null)
    {
        \Cake\Core\Configure::write('debug',TRUE);
        $classId = $this->Students->Classrooms->find()->hydrate(false)->select(['id'])->where(['slug' => $cSlug])->first();
        $studentList = $this->Students->find()
                ->select([
                    'id','studentid','first_name','last_name','image','slug'
                ])
                ->where([
                    'Students.school_id' => $this->Auth->user('school_id'),
                    'Students.session' => $this->Auth->user('session'),
                    'Students.classroom_id' => $classId['id'],
                ])->order(['first_name' => 'asc']);
        $students = $this->paginate($studentList);
        $this->loadModel('Resultcategories');
        $resultcategories = $this->Resultcategories->find('list',['keyField' => 'id','valueField' => 'name'])->where([
            'school_id' => $this->Auth->user('school_id'),
            'session' => $this->Auth->user('session')
        ])->toArray();
        
        if($this->request->is(['post','put'])){
            $d = $this->request->data;
            $resultcategories = $this->Resultcategories->find()->where(['id' => $d['resultcategories']])->first();
            $studentSlug = $d['studentslug'];
            $url = "$studentSlug/$resultcategories->slug";
            return $this->redirect(['controller'=>'students','action'=>"add-result",$url]);
        }
        $this->set(compact('students','resultcategories'));
        $this->set('_serialize', ['students']);
    }

    /**
     * View method
     *
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $student = $this->Students->find()
                ->contain([
                    'Schools' => function($q){return $q->select(['id','name']);},
                    'Classrooms' => function($q){return $q->select(['id','name','section'])->where(['Classrooms.status'=>1,'Classrooms.deleted' => 0]);},
                    'Guardians' => function($q){return $q->select(['id','mobile'])->where(['Guardians.status'=>1,'Guardians.deleted' => 0]);},
                    'Areas' => function($q){return $q->select(['id','name'])->where(['Areas.status'=>1,'Areas.deleted' => 0]);},
                    'Cities' => function($q){return $q->select(['id','name'])->where(['Cities.status'=>1,'Cities.deleted' => 0]);},
                    'States' => function($q){return $q->select(['id','name'])->where(['States.status'=>1,'States.deleted' => 0]);},
                    'Countries' => function($q){return $q->select(['id','name'])->where(['Countries.status'=>1,'Countries.deleted' => 0]);}
                ])
                ->where(['Students.slug' => $slug])
                ->first();
        $this->set('student', $student);
        $this->set('_serialize', ['student']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($cSlug = null)
    {
        \Cake\Core\Configure::write('debug',TRUE);
        $classId = $this->Students->Classrooms->find()->hydrate(false)->select(['id'])->where(['slug' => $cSlug])->first();
        $student = $this->Students->newEntity();
        if ($this->request->is('post')) {
            $d = $this->request->data;
            $d['Guardian']['status'] = 1;
            $d['Guardian']['name'] = $d['father_name'];
            $d['school_id'] = $this->Auth->user('school_id');
            $d['session'] = $this->Auth->user('session');
            $d['status'] = 1;
            $d['classroom_id'] = $classId['id'];
            $d['teacher_id'] = $this->Auth->user('id');
            $student = $this->Students->patchEntity($student, $d);
            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student has been saved.'));
                return $this->redirect(['action' => 'index',$cSlug]);
            } else {
                $this->Flash->error(__('The student could not be saved. Please, try again.'));
            }
        }
        $classrooms = $this->Students->Classrooms->find('list', ['keyField' => 'id','valueField' => 'class_name'])
                ->where(['school_id' => $this->Auth->user('school_id')]);
        $areas = $this->Students->Areas->find('list', ['limit' => 200]);
        $cities = $this->Students->Cities->find('list', ['limit' => 200]);
        $states = $this->Students->States->find('list', ['limit' => 200]);
        $countries = $this->Students->Countries->find('list', ['limit' => 200]);
        $this->set(compact('student', 'classrooms', 'areas', 'cities', 'states', 'countries'));
        $this->set('_serialize', ['student']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($slug = null)
    {
        $student = $this->Students->find()->contain([
            'Guardians' => function($q){return $q->select(['id','mobile','name','email'])->where(['Guardians.status'=>1,'Guardians.deleted' => 0]);},
        ])->where(['Students.slug' => $slug])->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $d = $this->request->data;
            $d['guardian']['name'] = $d['father_name'];
            $student = $this->Students->patchEntity($student, $d);
            
            if ($this->Students->save($student)) {
                $this->loadModel('Mobilelocals');
                $this->Mobilelocals->updateAll(['value' => 1], [
                    'classroom_id' => $student->classroom_id,
                    'school_id' => $student->school_id,
                    'model_name' => 'Students'
                ]);
                $this->Flash->success(__('The student has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The student could not be saved. Please, try again.'));
            }
        }
        $areas = $this->Students->Areas->find('list', ['limit' => 200]);
        $cities = $this->Students->Cities->find('list', ['limit' => 200]);
        $states = $this->Students->States->find('list', ['limit' => 200]);
        $countries = $this->Students->Countries->find('list', ['limit' => 200]);
        $this->set(compact('student', 'areas', 'cities', 'states', 'countries'));
        $this->set('_serialize', ['student']);
    }
    
    /*
     * Student Fee
     */
    
    public function fee($stSlug= null){
        $this->loadModel('Settings');
        $student = $this->Students->find()->where([
            'Students.slug' => $stSlug
        ])->select([
            'id','school_id','classroom_id','studentid','session','first_name','last_name','is_bus','father_name','guardian_mobile_1','image'
        ])->first();
        $studentfees = $this->Students->Studentfees->find()->where([
            'Studentfees.student_id' => $student->id,'Studentfees.session'=>$this->Auth->user('session')
        ])->contain([
            'Schoolfees' => function($q){
                return $q->select(['id','month','fee','session'])->where(['Schoolfees.session'=>$this->Auth->user('session')]);
            }
        ])->select([
            'id','fee','discount','reason','date','bus_fee'
        ])
        ->orderDesc('Studentfees.id')->toArray();
        $busfees = "";
        if($student->is_bus){
            $this->loadModel('Schoolbusfees');
            $busfees = $this->Schoolbusfees->find()->where([
                'school_id' => $student->school_id,
                'session' => $student->session,
                'status' => 1
            ])->select([
                'distance','fee'
            ])->toArray();
        }
        $startmonth = $this->Settings->find()->select(['type','value'])->where(['type'=>'session_start_month'])->first();
        $schoolFee = $this->loadModel('Schoolfees');
        $schoolfees = $this->Schoolfees->find()
                ->select(['id','school_id','classroom_id','month','fee','session'])
                ->where(['school_id' => $student->school_id,'session' => $this->Auth->user('session'),'status'=>1])
                ->toArray();
        
        if($this->request->is(['post','put'])){
            $this->loadModel('Schoolfees');
            $d = $this->request->data;
            foreach($d['month'] as $month){
                $v = explode(":", $month);
                $scMonthFee = $this->Schoolfees->find()->where([
                    'month' => $v[0],
                    'school_id' => $v[1],
                    'classroom_id' => $v[2],
                    'session' => $v[3]
                ])->first();
                $fee = $d['fee'];
                if($d['discount']){
                $discountFee = $d['discount'];
                }else{
                    $discountFee = 0;
                }
                $busFee = 0;
                if($d['busfee']){
                    $busFee = $d['busfee']/count($d['month']);
                }
                if($d['discount']){
                    $fee = $scMonthFee->fee - $d['discount']/count($d['month']);
                    $discountFee = $d['discount']/count($d['month']);
                }
                $d1[] = [
                    'school_id' => $v[1],
                    'student_id' => $d['student_id'],
                    'classroom_id' => $v[2],
                    'schoolfee_id' => $scMonthFee->id,
                    'fee' => $fee,
                    'discount' => $discountFee,
                    'reason' => $d['reason'],
                    'date' => date('d-F-Y'),
                    'status' => 1,
                    'deleted' => 0,
                    'session' => $v[3],
                    'bus_fee' =>$busFee
                ];
            }
            $d1 = $this->Students->Studentfees->newEntities($d1);
            foreach($d1 as $d2){
                $res = $this->Students->Studentfees->save($d2);
            }
            if($res){
                return $this->redirect($this->referer());
            }
        }
        
        $this->set(compact('student','startmonth','schoolfees','studentfees','busfees'));
        $this->set('_serialize',['student','startmonth','schoolfees','studentfees','busfees']);
    }
    
    

    











    public function addResult($stSlug,$rCtSlug){
        $student = $this->Students->find()
                ->select(['id','first_name','last_name','classroom_id'])
                ->where(['Students.slug' => $stSlug])
                ->first();
        $this->loadModel('Resultcategories');
        $resultcategory = $this->Resultcategories->find()
                ->select(['id'])
                ->where(['slug' => $rCtSlug])
                ->first();
        if($this->request->is(['post','put'])){
            $d = $this->request->data;
            foreach ($d['result'] as $dSave){
                $dSave['resultcategory_id'] = $resultcategory->id;
                $dSave['school_id'] = $this->Auth->user('school_id');
                $dSave['classroom_id'] = $student['classroom_id'];
                $dSave['student_id'] = $student['id'];
                $dSave['status'] = 1;
                $dSave['session'] = $this->Auth->user('session');
                $checkRecord = $this->Students->Results->find()
                        ->where([
                            'resultcategory_id' => $resultcategory->id,
                            'school_id' => $this->Auth->user('school_id'),
                            'classroom_id' => $dSave['classroom_id'],
                            'student_id' => $dSave['student_id'],
                            'subject_id' => $dSave['subject_id'],
                            'session' => $this->Auth->user('session')
                        ])
                        ->first();
                if($checkRecord){
                    $dataSave = $this->Students->Results->patchEntity($checkRecord,$dSave);
                    
                }else{
                    $dataSave = $this->Students->Results->newEntity($dSave);
                }
                $this->Students->Results->save($dataSave);
                unset($dataSave);
            }
        }
        
        $this->loadModel('Subjects');
        $condition = [
            'student_id' => $student->id,
            'resultcategory_id' => $resultcategory->id,
            'session' => $this->Auth->user('session'),
            'school_id' => $this->Auth->user('school_id')
        ];
        $subjects = $this->Subjects->find()
                ->select(['id','name'])
                ->contain([
                    'Results' => function($q) use($condition){
                        return $q->where($condition);
                    }
                ])
                ->where(['Subjects.school_id' => $this->Auth->user('school_id')])
                ->order(['Subjects.name' => 'asc']);
        $this->set(compact('student', 'resultcategories','subjects','resultmarks'));
        $this->set('_serialize', ['student']);
    }
    
    public function addResultByClass($cSlug = null,$rCtSlug=null,$subSlug=null){
        $this->loadModel('Resultcategories');
        $resultcategory = $this->Resultcategories->find()
                ->select(['id'])
                ->where(['slug' => $rCtSlug])
                ->first();
        $this->loadModel('Subjects');
        $subject = $this->Subjects->find()
                ->select(['id'])
                ->where(['slug' => $subSlug])
                ->first();
        $rsultCntainCnditon = [
            'Results.session' => $this->Auth->user('session'),
            'Results.school_id' => $this->Auth->user('school_id'),
            'Results.subject_id' => $subject->id,
            'Results.resultcategory_id'=>$resultcategory->id];
        $classroom = $this->Students->Classrooms->find()
                ->select(['id','name','section'])
                ->contain([
                    'Students' => function($q){
                        return $q->select(['id','classroom_id','first_name','last_name','image'])
                                ->where(['session' => $this->Auth->user('session')])->order(['first_name' => 'asc']);
                    },
                    'Students.Results' => function($q) use($rsultCntainCnditon){
                        return $q->select(['id','subject_id','student_id','get_marks','total_mark'])->where($rsultCntainCnditon);
                    }
                ])
                ->where(['Classrooms.slug' => $cSlug])->first();
        if($this->request->is(['post','put'])){
            $d = $this->request->data;
            foreach ($d['result'] as $dSave){
                $dSave['resultcategory_id'] = $resultcategory->id;
                $dSave['school_id'] = $this->Auth->user('school_id');
                $dSave['classroom_id'] = $classroom['id'];
                $dSave['subject_id'] = $subject->id;
                $dSave['status'] = 1;
                $dSave['session'] = $this->Auth->user('session');
                $dSave['total_mark'] = $d['total_mark'];
                $checkRecord = $this->Students->Results->find()
                        ->where([
                            'resultcategory_id' => $resultcategory->id,
                            'school_id' => $this->Auth->user('school_id'),
                            'classroom_id' => $dSave['classroom_id'],
                            'student_id' => $dSave['student_id'],
                            'subject_id' => $dSave['subject_id'],
                            'session' => $this->Auth->user('session')
                        ])
                        ->first();
                if($checkRecord){
                    $dataSave = $this->Students->Results->patchEntity($checkRecord,$dSave);
                }else{
                    $dataSave = $this->Students->Results->newEntity($dSave);
                }
                $this->Students->Results->save($dataSave);
                unset($dataSave);
            }
            return $this->redirect($this->referer());
        }
        $this->set(compact(['classroom']));
        $this->set('_serialize',['classroom']);
    }
}
