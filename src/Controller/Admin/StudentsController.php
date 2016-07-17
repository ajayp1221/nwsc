<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 */
class StudentsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    
    public function index()
    {
        $this->paginate = [
            'contain' => ['Schools', 'Classrooms', 'Guardians', 'Areas', 'Cities', 'States', 'Countries']
        ];
        $query = $this->Students->find()->where([
            'Students.school_id' => $this->Cookie->read('selectedSchool')['id'],
            'Students.session' => $this->Cookie->read('selectedSchool')['session']
        ]);
        $this->set('students', $this->paginate($query));
        $this->set('_serialize', ['students']);
    }

    /**
     * View method
     *
     * @param string|null $id Student id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $student = $this->Students->findBySlug($slug)
            ->contain(['Schools', 'Classrooms', 'Guardians', 'Areas', 'Cities', 'States', 'Countries', 'Schoolfees', 'Results'
        ])->firstOrFail();
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
        \Cake\Core\Configure::write('debug',TRUE);
        $student = $this->Students->newEntity();
        if ($this->request->is('post')) {
            $d = $this->request->data;

            $d['school_id'] = $this->Cookie->read('selectedSchool')['id'];
            $d['session'] =  $this->Cookie->read('selectedSchool')['session'];
            $d['status'] = 1;
            $student = $this->Students->patchEntity($student, $d);
            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The student could not be saved. Please, try again.'));
            }
        }
        $classrooms = $this->Students->Classrooms->find('list', ['keyField' => 'id','valueField' => 'class_name'])
                ->where(['school_id' => $this->Cookie->read('selectedSchool')['id']]);
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
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($slug = null)
    {
        $student = $this->Students->findBySlug($slug)->contain(['Schoolfees'])->firstOrFail();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['password'] = 123456;
            $this->request->data['school_id'] = $this->Cookie->read('selectedSchool')['id'];
            $student = $this->Students->patchEntity($student, $this->request->data);
            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The student could not be saved. Please, try again.'));
            }
        }
        $classrooms = $this->Students->Classrooms->find('list', ['limit' => 200]);
        $areas = $this->Students->Areas->find('list', ['limit' => 200]);
        $cities = $this->Students->Cities->find('list', ['limit' => 200]);
        $states = $this->Students->States->find('list', ['limit' => 200]);
        $countries = $this->Students->Countries->find('list', ['limit' => 200]);
        $this->set(compact('student', 'schools', 'classrooms', 'teachers', 'guardians', 'areas', 'cities', 'states', 'countries', 'schoolfees'));
        $this->set('_serialize', ['student']);
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
    
    public function studentid(){
        $students = $this->Students->find()->where(['studentid' => ''])->select(['id'])->toArray();
        $result = [];
        foreach($students as $student){
            $result[] = $this->Students->updateAll(['studentid'=>"sc$student->id"],['id' => $student->id]);
        }
        $this->set(compact('result'));
        $this->set('_serilaze',[$result]);
    }
}
