<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Classrooms Controller
 *
 * @property \App\Model\Table\ClassroomsTable $Classrooms
 * @property \App\Model\Table\MobilelocalsTable $Mobilelocals
 */
class ClassroomsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Schools']
        ];
        $query = $this->Classrooms->find()->where(['school_id' => $this->Cookie->read('selectedSchool')['id']]);
        $this->set('classrooms', $this->paginate($query));
        $this->set('_serialize', ['classrooms']);
    }

    /**
     * View method
     *
     * @param string|null $id Classroom id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $classroom = $this->Classrooms->findBySlug($slug)
                ->contain(['Schools', 'Teachers', 'Results', 'Schoolfees', 'Students', 'StudentsSchoolfees'])
                ->firstOrFail();
        $this->set('classroom', $classroom);
        $this->set('_serialize', ['classroom']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $classroom = $this->Classrooms->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['status'] = 1;
            $classroom = $this->Classrooms->patchEntity($classroom, $this->request->data);
            if ($this->Classrooms->save($classroom)) {
                $this->loadModel('Mobilelocals');
                $this->Mobilelocals->updateAll([
                    'value' => 1
                ], [
                    'school_id' => $this->Cookie->read('selectedSchool')['id'],
                    'model_name' => 'Classrooms',
                ]);
                $this->Flash->success(__('The classroom has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The classroom could not be saved. Please, try again.'));
            }
        }
        $schools = $this->Classrooms->Schools->find('list', ['limit' => 200]);
        $teachers = $this->Classrooms->Teachers->find('list', ['limit' => 200]);
        $this->set(compact('classroom', 'schools', 'teachers'));
        $this->set('_serialize', ['classroom']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Classroom id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($slug = null)
    {
        $classroom = $this->Classrooms->findBySlug($slug)->firstOrFail();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $classroom = $this->Classrooms->patchEntity($classroom, $this->request->data);
            if ($this->Classrooms->save($classroom)) {
                $this->loadModel('Mobilelocals');
                $this->Mobilelocals->updateAll([
                    'value' => 1
                ], [
                    'school_id' => $this->Cookie->read('selectedSchool')['id'],
                    'model_name' => 'Classrooms',
                ]);
                $this->Flash->success(__('The classroom has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The classroom could not be saved. Please, try again.'));
            }
        }
        $schools = $this->Classrooms->Schools->find('list', ['limit' => 200]);
        $teachers = $this->Classrooms->Teachers->find('list', ['limit' => 200]);
        $this->set(compact('classroom', 'schools', 'teachers'));
        $this->set('_serialize', ['classroom']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Classroom id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $classroom = $this->Classrooms->get($id);
        if ($this->Classrooms->delete($classroom)) {
            $this->Flash->success(__('The classroom has been deleted.'));
        } else {
            $this->Flash->error(__('The classroom could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    public function timetablelist($slug = null){
        $classroom = $this->Classrooms->findBySlug($slug)
                ->contain([
                    'Timetables' => function($q){return $q->order(['Timetables.id' => 'asc']);} ,
                    'Timetables.Subjects' =>  function($qry){
                        return $qry->select([
                            'name', 'slug'
                        ])->where(['Subjects.status' => 1]);
                    },
                    'Timetables.Teachers' =>  function($qry){
                        return $qry->select([
                            'first_name', 'last_name', 'slug'
                        ])->where(['Teachers.school_id' => $this->Cookie->read('selectedSchool')['id']]);
                    }
                ])
                ->firstOrFail();
//                debug($classroom);exit;
        $this->set('classroom', $classroom);
        $this->set('_serialize', ['classroom']);
    }
    public function addtimetables($slug = NULL){
        $classrooms = $this->Classrooms->findBySlug($slug)->firstOrFail();
        if($this->request->is(['post', 'put'])){
            $schoolInfo = $this->Classrooms->Schools->find()
                    ->select(['session','id'])
                    ->where(['id' => $this->Cookie->read('selectedSchool')['id']])
                    ->first();
            $this->loadModel('Timetables');
            $result = [];
            foreach($this->request->data['Classrooms'] as $data){
                /*--------------------   Monday  -------------------*/
                if($data['monday_teacher_id'] && $data['monday_subject_id'] ){
                    $mondaydata['status'] = 1;
                    $mondaydata['period_time'] = $data['period_time'];
                    $mondaydata['period_no'] = $data['period_no'];
                    $mondaydata['days'] = 'Monday';
                    $mondaydata['classroom_id'] = $this->request->data['classroom_id'];
                    $mondaydata['teacher_id'] = $data['monday_teacher_id'];
                    $mondaydata['subject_id'] = $data['monday_subject_id'];
                    $mondaydata['school_id'] = $this->Cookie->read('selectedSchool')['id'];
                    $mondaydata['session'] = $schoolInfo->session;
                    $mondaydatasave = $this->Timetables->newEntity($mondaydata);
                    $result['monday'] = $this->Timetables->save($mondaydatasave);
                }
                /*--------------------   Tuseday  -------------------*/
                if($data['tuesday_teacher_id'] && $data['tuesday_subject_id'] ){
                    $tuesdaydata['days'] = 'Tuesday';
                    $tuesdaydata['status'] = 1;
                    $tuesdaydata['period_no'] = $data['period_no'];
                    $tuesdaydata['period_time'] = $data['period_time'];
                    $tuesdaydata['classroom_id'] = $this->request->data['classroom_id'];
                    $tuesdaydata['teacher_id'] = $data['tuesday_teacher_id'];
                    $tuesdaydata['subject_id'] = $data['tuesday_subject_id'];
                    $tuesdaydata['school_id'] = $this->Cookie->read('selectedSchool')['id'];
                    $tuesdaydata['session'] = $schoolInfo->session;
                    $tuesdaydatasave = $this->Timetables->newEntity($tuesdaydata);
                    $result['tuseday'] = $this->Timetables->save($tuesdaydatasave);
                }
                /*--------------------   Wednesday  -------------------*/
                if($data['wednesday_teacher_id'] && $data['wednesday_subject_id'] ){
                    $wednesdaydata['days'] = 'Wednesday';
                    $wednesdaydata['status'] = 1;
                    $wednesdaydata['period_time'] = $data['period_time'];
                    $wednesdaydata['period_no'] = $data['period_no'];
                    $wednesdaydata['classroom_id'] = $this->request->data['classroom_id'];
                    $wednesdaydata['teacher_id'] = $data['wednesday_teacher_id'];
                    $wednesdaydata['subject_id'] = $data['wednesday_subject_id'];
                    $wednesdaydata['school_id'] = $this->Cookie->read('selectedSchool')['id'];
                    $wednesdaydata['session'] = $schoolInfo->session;
                    $wednesdaydatasave = $this->Timetables->newEntity($wednesdaydata);
                    $result['wednesday'] = $this->Timetables->save($wednesdaydatasave);
                }
                /*--------------------   Thursday  -------------------*/
                if($data['thursday_teacher_id'] && $data['thursday_subject_id'] ){
                    $thursdaydata['days'] = 'Thursday';
                    $thursdaydata['status'] = 1;
                    $thursdaydata['period_time'] = $data['period_time'];
                    $thursdaydata['period_no'] = $data['period_no'];
                    $thursdaydata['classroom_id'] = $this->request->data['classroom_id'];
                    $thursdaydata['teacher_id'] = $data['thursday_teacher_id'];
                    $thursdaydata['subject_id'] = $data['thursday_subject_id'];
                    $thursdaydata['school_id'] = $this->Cookie->read('selectedSchool')['id'];
                    $thursdaydata['session'] = $schoolInfo->session;
                    $thursdaydatasave = $this->Timetables->newEntity($thursdaydata);
                    $result['thursday'] = $this->Timetables->save($thursdaydatasave);
                }
                /*--------------------   Friday  -------------------*/
                if($data['friday_teacher_id'] && $data['friday_subject_id'] ){
                    $fridaydata['days'] = 'Friday';
                    $fridaydata['period_time'] = $data['period_time'];
                    $fridaydata['period_no'] = $data['period_no'];
                    $fridaydata['status'] = 1;
                    $fridaydata['classroom_id'] = $this->request->data['classroom_id'];
                    $fridaydata['teacher_id'] = $data['friday_teacher_id'];
                    $fridaydata['subject_id'] = $data['friday_subject_id'];
                    $fridaydata['school_id'] = $this->Cookie->read('selectedSchool')['id'];
                    $fridaydata['session'] = $schoolInfo->session;
                    $fridaydatasave = $this->Timetables->newEntity($fridaydata);
                    $result['friday'] = $this->Timetables->save($fridaydatasave);
                }
                /*--------------------   Saturday  -------------------*/
                if($data['saturday_teacher_id'] && $data['saturday_subject_id'] ){
                    $saturdaydata['status'] = 1;
                    $saturdaydata['period_time'] = $data['period_time'];
                    $saturdaydata['period_no'] = $data['period_no'];
                    $saturdaydata['days'] = 'Saturday';
                    $saturdaydata['classroom_id'] = $this->request->data['classroom_id'];
                    $saturdaydata['teacher_id'] = $data['saturday_teacher_id'];
                    $saturdaydata['subject_id'] = $data['saturday_subject_id'];
                    $saturdaydata['school_id'] = $this->Cookie->read('selectedSchool')['id'];
                    $saturdaydata['session'] = $schoolInfo->session;
                    $saturdaydatasave = $this->Timetables->newEntity($saturdaydata);
                    $result['saturday'] = $this->Timetables->save($saturdaydatasave);
                }
            }
        }
        $teacher = $this->Classrooms->Teachers->find('list', ['keyField' => 'id','valueField' => 'full_name'])
                ->where([
                    'school_id' => $this->Cookie->read('selectedSchool')['id'],
                    'session' => $this->Cookie->read('selectedSchool')['session']
                ]);
        $this->loadModel('Subjects');
        $this->loadModel('Settings');
        
        $settings = $this->Settings->find()->where([
            'status' => 1,
            'deleted' => 0,
            'school_id' => $this->Cookie->read('selectedSchool')['id']
        ])
        ->select(['type','value'])
        ->order(['type' => 'asc'])
        ->toArray();
        $subjects = $this->Subjects->find('list')->where(['school_id' => $this->Cookie->read('selectedSchool')['id']]);
        $this->set(compact('teacher', 'classrooms', 'subjects','settings'));
        $this->set('_serialize', ['classrooms']);
    }
}
