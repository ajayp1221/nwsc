<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Holidays Controller
 *
 * @property \App\Model\Table\HolidaysTable $Holidays
 * @property \App\Model\Table\SchoolsTable $Schools
 */
class HolidaysController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $qry = $this->Holidays->find()->contain(['Schools'])->where(['school_id' => $this->Cookie->read('selectedSchool')['id']]);
        $results = $this->paginate($qry);
        $this->set('holidays', $results);
        $this->set('_serialize', ['holidays']);
    }

    /**
     * View method
     *
     * @param string|null $id Holiday id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $holiday = $this->Holidays->findBySlug($slug)->contain(['Schools'])->firstOrFail();
        $this->set('holiday', $holiday);
        $this->set('_serialize', ['holiday']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $holiday = $this->Holidays->newEntity();
        if ($this->request->is('post')) {
            $d = $this->request->data;
            $d['session'] = $this->Cookie->read('selectedSchool')['session'];
            $holiday = $this->Holidays->patchEntity($holiday, $d);
            if ($this->Holidays->save($holiday)) {
                $this->Flash->success(__('The holiday has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The holiday could not be saved. Please, try again.'));
            }
        }
        $schools = $this->Holidays->Schools->find('list')->where(['school_id' =>  $this->Cookie->read('selectedSchool')['id']]);
        $this->set(compact('holiday', 'schools'));
        $this->set('_serialize', ['holiday']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Holiday id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($slug = null)
    {
        $holiday = $this->Holidays->findBySlug($slug)->firstOrFail();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $holiday = $this->Holidays->patchEntity($holiday, $this->request->data);
            if ($this->Holidays->save($holiday)) {
                $this->Flash->success(__('The holiday has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The holiday could not be saved. Please, try again.'));
            }
        }
        $schools = $this->Holidays->Schools->find('list')->where(['school_id' =>  $this->Cookie->read('selectedSchool')['id']]);
        $this->set(compact('holiday', 'schools'));
        $this->set('_serialize', ['holiday']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Holiday id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $holiday = $this->Holidays->get($id);
        if ($this->Holidays->delete($holiday)) {
            $this->Flash->success(__('The holiday has been deleted.'));
        } else {
            $this->Flash->error(__('The holiday could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function leaveCronHoliday() {
        $date = date("d-m-Y") ;
        $startTimestamp = date("d-m-Y")."00:00:00";
        $endTimestamp = date("d-m-Y H:i:s");
        $startTimestamp = strtotime($startTimestamp);
        $endTimestamp = strtotime($endTimestamp);
        $this->loadModel('Holidays');
        $holidays = $this->Holidays->find()->where(['date' => $date])->toarray();
        foreach($holidays as $holiday){
            $schoolInfo=[
                'session' => $holiday->session,
                'school_id' => $holiday->school_id
            ];
            $school = $this->Holidays->Schools->find()
                    ->select(['id'])
                    ->contain([
                    'Students' => function($q)use($schoolInfo){
                        return $q->select(['id','school_id','classroom_id','first_name','last_name','image','session'])
                                ->where([
                                    'school_id' =>  $schoolInfo['school_id'],
                                    'session' => $schoolInfo['session']
                                ])
                                ->order(['first_name' => 'asc'])
                                ->contain([
                                    'Studentattendances' => function($q1){
                                        return $q1->where(['date' => date('d-m-Y')])
                                                ->order(['id' => 'desc']);
                                    }
                                ]);
                    }])->where([
                        'status' => 1,'id' => $holiday->school_id
                    ])->first();
            foreach($school->students as $students){
                $data = [
                    'school_id' => $holiday->school_id,
                    'student_id' => $students->id,
                    'classroom_id' => $students->classroom_id,
                    'attendance' => 0,
                    'status' => 1,
                    'date' => date("d-m-Y"),
                    'session' => $holiday->session
                ];
                if (@$students->studentattendances[0]) {
                    $data = $this->Schools->Studentattendances->patchEntity($students->studentattendances[0],$data);
                }else{
                    $data = $this->Schools->Studentattendances->newEntity($data);
                }
                $result[] = $this->Schools->Studentattendances->save($data);
            }
        }
        $this->set(compact(['result']));
        $this->set('_serialize','result');
    }
    public function leaveCronSunday(){
        $date = date("Y-m-d");
        $day = date('l', strtotime($date));
        if ($day == "Sunday") {
            $this->loadModel('Schools');
            $schools = $this->Schools->find()->where(['status' => 1])->select([
                'id','session'
            ])->toArray();
            foreach($schools as $school){
                $students = $this->Schools->Students->find()->where([
                    'school_id' => $school->id,
                    'session' => $school->session
                ])->contain([
                    'Studentattendances' => function($q1){
                        return $q1->where(['date' => date('d-m-Y')])
                                ->order(['id' => 'desc']);
                    }
                ])->select([
                    'id','school_id','classroom_id'
                ])->order(['first_name' => 'asc'])->toArray();
                foreach($students as $student){
                    $data = [
                       'school_id' => $student->school_id,
                       'student_id' => $student->id,
                       'classroom_id' => $student->classroom_id,
                       'attendance' => 0,
                       'status' => 1,
                       'date' => date("d-m-Y"),
                       'session' => $school->session
                   ];
                   if (@$student->studentattendances[0]) {
                       $data = $this->Schools->Studentattendances->patchEntity($student->studentattendances[0],$data);
                   }else{
                       $data = $this->Schools->Studentattendances->newEntity($data);
                   }
                   $result[] = $this->Schools->Studentattendances->save($data);
               }
            }
        }else{
            $result['msg'] = "Today is not sunday";
        }
        $this->set(compact(['result']));
        $this->set('_serialize','result');
    }
}
