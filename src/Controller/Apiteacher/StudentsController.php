<?php
namespace App\Controller\Apiteacher;

use App\Controller\Apiteacher\AppController;

/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 * @property \App\Model\Table\MobilelocalsTable $Mobilelocals
 */
class StudentsController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Schools', 'Classrooms', 'Teachers', 'Guardians', 'Areas', 'Cities', 'States', 'Countries']
        ];
        $this->set('students', $this->paginate($this->Students));
        $this->set('_serialize', ['students']);
    }

    /**
     * View method
     *
     * @param string|null $id Student id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $student = $this->Students->get($id, [
            'contain' => ['Schools', 'Classrooms', 'Teachers', 'Guardians', 'Areas', 'Cities', 'States', 'Countries', 'Schoolfees', 'Results', 'Studentattendances', 'Studentfees']
        ]);
        $this->set('student', $student);
        $this->set('_serialize', ['student']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $student = $this->Students->newEntity();
        if ($this->request->is('post')) {
            $d = $this->request->data;
            $this->rq($d);
            $d['Guardian']['mobile'] = $d['guardian_mobile'];
            $d['Guardian']['email'] = $d['guardian_email'];
            if($d['Guardian']['mobile']){
                $d['Guardian']['mobile'] = $d['guardian_mobile'];
                $parentInfo = $this->Students->Guardians->find()
                        ->select('id')
                        ->where([
                            'OR' =>[
                                'email' => $d['Guardian']['email'],
                                'mobile' => $d['Guardian']['mobile']
                            ]
                        ])
                        ->first();
                if(isset($parentInfo)){
                    $d['guardian_id'] = $parentInfo->id;
                    unset($d['Guardian']);
                }else{
                    $d['Guardian']['status'] = 1;
                    $d['Guardian']['name'] = $d['father_name'];
                    $d['Guardian']['password'] = $d['guardian_mobile'];
                    $d['Guardian']['app_pwd'] = $d['guardian_mobile'];
                    $parent = $this->Students->Guardians->newEntity();
                    $this->Students->Guardians->patchEntity($parent, $d['Guardian']);
                    $res = $this->Students->Guardians->save($parent);
                    $d['guardian_id'] = $res->id;
                }
            }
            $student = $this->Students->patchEntity($student, $d);
            if ($this->Students->save($student)) {
                $this->loadModel('Mobilelocals');
                $this->Mobilelocals->updateAll(['value' => 1], [
                    'classroom_id' => $d['classroom_id'],
                    'school_id' => $d['school_id'],
                    'model_name' => 'Students'
                ]);
                $result['error'] = 0;
                $result['msg'] = "Student has been added successfully";
            } else {
                $result['error'] = 1;
                $result['msg'] = "Something went wrong please try again";
            }
        }
        $this->set('result', $result);
        $this->set('_serialize', ['result']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Student id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $student = $this->Students->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $student = $this->Students->patchEntity($student, $this->request->data);
            if ($this->Students->save($student)) {
                $this->loadModel('Mobilelocals');
                $this->Mobilelocals->updateAll(['value' => 1], [
                    'classroom_id' => $student->classroom_id,
                    'school_id' => $student->school_id,
                    'model_name' => 'Students'
                ]);
                $result['error'] = 0;
                $result['msg'] = "Changes done successfully";
            } else {
                $result['error'] = 1;
                $result['msg'] = "something went wrong please try again";
            }
        }
        $this->set('result', $result);
        $this->set('_serialize', ['result']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $student = $this->Students->get($id);
        if ($this->Students->delete($student)) {
            $this->Flash->success(__('The student has been deleted.'));
        } else {
            $this->Flash->error(__('The student could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function changestatus(){
        if($this->request->is('post')){
            $response = $this->Students->updateAll(['status' => $this->request->data['status']],['id' => $this->request->data['id']]);
            if($response){
                $result['error'] = 0;
                $result['msg'] = "chnages done successfully";
            }else{
                $result['error'] = 1;
                $result['msg'] = "something went wrong please try again";
            }
            $this->set('result', $result);
            $this->set('_serialize', ['result']);
        }
    }
    
    public function studentListByClass(){
        $this->request->allowMethod(['post', 'put']);
        $d = $this->request->data;
//        $d['subject_id']=1;
//        $d['classroom_id']=1;
//        $d['resultcategory_id']=1;
//        $d['school_id']=1;
//        $d['session']="2015-2016";
        
        $this->rq($d);
        $rsultCntainCnditon = [
            'Results.session' => $d['session'],
            'Results.school_id' => $d['school_id'],
            'Results.subject_id' => $d['subject_id'],
            'Results.resultcategory_id' => $d['resultcategory_id']];
        $students = $this->Students->find()
                ->select(['id','classroom_id','first_name','last_name','image'])
                ->contain([
                        'Results' => function($q) use($rsultCntainCnditon){
                            return $q->select(['id','subject_id','student_id','get_marks','total_mark'])->where($rsultCntainCnditon);
                        }
                ])
                ->where([
                    'Students.classroom_id' => $d['classroom_id'],
                    'Students.session' => $d['session'],
                    'Students.school_id' => $d['school_id'],
                ])
                ->order(['first_name' => 'asc'])->toArray();
        $this->set(compact(['students']));
        $this->set('_serialize',['students']);
        
    }
}
