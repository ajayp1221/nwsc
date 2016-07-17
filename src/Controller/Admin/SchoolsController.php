<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Schools Controller
 *
 * @property \App\Model\Table\SchoolsTable $Schools
 */
class SchoolsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $schoolsList = $this->Schools->find()
                ->contain(['Users', 'Areas', 'Cities', 'States', 'Countries'])
                ->where(['Schools.user_id' => $this->Auth->user('id'),'Schools.status' => 1,'Schools.deleted' => 0]);
        $this->set('schools', $this->paginate($schoolsList));
        $this->set('_serialize', ['schools']);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function lists()
    {
        $schoolsList = $this->Schools->find()
                ->contain(['Users', 'Areas', 'Cities', 'States', 'Countries'])->orderDesc('Schools.id');
        $this->set('schools', $this->paginate($schoolsList));
        $this->set('_serialize', ['schools']);
    }

    /**
     * View method
     *
     * @param string|null $id School id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $school = $this->Schools->findBySlug($slug)->contain([
                    'Areas', 'Cities', 'States', 'Countries', 'Classrooms', 'Holidays','Students', 'Teachers','Schoolspayments'
                ])->firstOrFail();
        $this->set('school', $school);
        $this->set('_serialize', ['school']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $school = $this->Schools->newEntity();
        if ($this->request->is('post')) {
            $d = $this->request->data;
            $d['status'] = 1;
            $schoolspayments = $d['schoolspayments'];
            $school = $this->Schools->patchEntity($school, $d);
            $result = $this->Schools->save($school);
            if ($result) {
                $data = [
                    [
                        'school_id' => $result->id,
                        'type' => "period_time",
                        'value' => 60,
                        'status' => 1
                    ],
                    [
                        'school_id' => $result->id,
                        'type' => "session",
                        'value' => "2016-2017",
                        'status' => 1
                    ],
                    [
                        'school_id' => $result->id,
                        'type' => "start_period",
                        'value' => "09:00",
                        'status' => 1
                    ],
                    [
                        'school_id' => $result->id,
                        'type' => "lunch",
                        'value' => 5,
                        'status' => 1
                    ],
                    [
                        'school_id' => $result->id,
                        'type' => "total_period",
                        'value' => 8,
                        'status' => 1
                    ],
                    [
                        'school_id' => $result->id,
                        'type' => "absent_sms_time",
                        'value' => "11:00",
                        'status' => 1
                    ],
                    [
                        'school_id' => $result->id,
                        'type' => "session_start_month",
                        'value' => "06",
                        'status' => 1
                    ]
                ];
                $saveSettings = $this->Schools->Settings->newEntities($data);
                foreach($saveSettings as $saveSetting){
                    $this->Schools->Settings->save($saveSetting);
                }
                $schoolspayments['school_id'] = $result->id;
                $schoolspayments['status'] = 1;
                $schoolspayments = $this->Schools->Schoolspayments->newEntity($schoolspayments);
                $this->Schools->Schoolspayments->save($schoolspayments);
                $this->Flash->success(__('The school has been saved.'));
                return $this->redirect(['action' => 'lists']);
            } else {
                $this->Flash->error(__('The school could not be saved. Please, try again.'));
            }
        }
        $users = $this->Schools->Users->find('list', ['limit' => 200])->order(['id' => 'desc']);
        $areas = $this->Schools->Areas->find('list', ['limit' => 200]);
        $cities = $this->Schools->Cities->find('list', ['limit' => 200]);
        $states = $this->Schools->States->find('list', ['limit' => 200]);
        $countries = $this->Schools->Countries->find('list', ['limit' => 200]);
        $this->set(compact('school', 'users', 'areas', 'cities', 'states', 'countries'));
        $this->set('_serialize', ['school']);
    }

    /**
     * Edit method
     *
     * @param string|null $id School id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($slug = null)
    {
        $school = $this->Schools->findBySlug($slug)->firstOrFail();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $school = $this->Schools->patchEntity($school, $this->request->data);
            if ($this->Schools->save($school)) {
                $this->Flash->success(__('The school has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The school could not be saved. Please, try again.'));
            }
        }
        $areas = $this->Schools->Areas->find('list', ['limit' => 200]);
        $cities = $this->Schools->Cities->find('list', ['limit' => 200]);
        $states = $this->Schools->States->find('list', ['limit' => 200]);
        $countries = $this->Schools->Countries->find('list', ['limit' => 200]);
        $this->set(compact('school', 'areas', 'cities', 'states', 'countries'));
        $this->set('_serialize', ['school']);
    }

    /**
     * Delete method
     *
     * @param string|null $id School id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $school = $this->Schools->get($id);
        if ($this->Schools->delete($school)) {
            $this->Flash->success(__('The school has been deleted.'));
        } else {
            $this->Flash->error(__('The school could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * Select School method
     */
    public function selectschool(){
        
        $school = $this->Schools
                ->find('list', ['keyField' => 'id', 'valueField' => 'name'])
                ->where([
                    'Schools.user_id' => $this->Auth->user('id')
                ])
                ->toArray();
        if ($this->request->is(['patch', 'post', 'put'])) {
            if(isset($this->request->data['schoolname'])){
                $schoolInfo = $this->Schools->find()->hydrate(false)->where(['id' => $this->request->data['schoolname']])->first();
                $this->Cookie->write('selectedSchool',$schoolInfo, true, "2 week");
                $this->Cookie->read('selectedSchool');
                $selectedSchool = $this->Cookie->read('selectedSchool')['id'];
            }
        }else{
            $selectedSchool = $this->Cookie->read('selectedSchool')['id'];
        }
        
        $this->set(compact('school', 'selectedSchool'));
        $this->set('school', $school);
    }
}
