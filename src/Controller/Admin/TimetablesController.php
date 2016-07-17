<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Timetables Controller
 *
 * @property \App\Model\Table\TimetablesTable $Timetables
 * @property \App\Model\Table\MobilelocalsTable $Mobilelocals
 */
class TimetablesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Schools', 'Classrooms', 'Subjects', 'Teachers']
        ];
        $this->set('timetables', $this->paginate($this->Timetables));
        $this->set('_serialize', ['timetables']);
    }

    /**
     * View method
     *
     * @param string|null $id Timetable id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $timetable = $this->Timetables->get($id, [
            'contain' => ['Schools', 'Classrooms', 'Subjects', 'Teachers']
        ]);
        $this->set('timetable', $timetable);
        $this->set('_serialize', ['timetable']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $timetable = $this->Timetables->newEntity();
        if ($this->request->is('post')) {
            $timetable = $this->Timetables->patchEntity($timetable, $this->request->data);
            if ($this->Timetables->save($timetable)) {
                $this->loadModel('Mobilelocals');
                $this->Mobilelocals->updateAll(['value' => 1], [
                    'school_id' => $this->Cookie->read('selectedSchool')['id'],
                    'model_name' => 'Timetables'
                ]);
                $this->Flash->success(__('The timetable has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The timetable could not be saved. Please, try again.'));
            }
        }
        $schools = $this->Timetables->Schools->find('list', ['limit' => 200]);
        $classrooms = $this->Timetables->Classrooms->find('list', ['limit' => 200]);
        $subjects = $this->Timetables->Subjects->find('list', ['limit' => 200]);
        $teachers = $this->Timetables->Teachers->find('list', ['limit' => 200]);
        $this->set(compact('timetable', 'schools', 'classrooms', 'subjects', 'teachers'));
        $this->set('_serialize', ['timetable']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Timetable id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $timetable = $this->Timetables->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $timetable = $this->Timetables->patchEntity($timetable, $this->request->data);
            if ($this->Timetables->save($timetable)) {
                $this->loadModel('Mobilelocals');
                $this->Mobilelocals->updateAll(['value' => 1], [
                    'school_id' => $this->Cookie->read('selectedSchool')['id'],
                    'model_name' => 'Timetables'
                ]);
                $this->Flash->success(__('The timetable has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The timetable could not be saved. Please, try again.'));
            }
        }
        $schools = $this->Timetables->Schools->find('list', ['limit' => 200]);
        $classrooms = $this->Timetables->Classrooms->find('list', ['limit' => 200]);
        $subjects = $this->Timetables->Subjects->find('list', ['limit' => 200]);
        $teachers = $this->Timetables->Teachers->find('list', ['limit' => 200]);
        $this->set(compact('timetable', 'schools', 'classrooms', 'subjects', 'teachers'));
        $this->set('_serialize', ['timetable']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Timetable id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $timetable = $this->Timetables->get($id);
        if ($this->Timetables->delete($timetable)) {
            $this->Flash->success(__('The timetable has been deleted.'));
        } else {
            $this->Flash->error(__('The timetable could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
