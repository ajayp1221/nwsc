<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Results Controller
 *
 * @property \App\Model\Table\ResultsTable $Results
 */
class ResultsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Resultcategories', 'Schools', 'Classrooms', 'Students', 'Subjects']
        ];
        $this->set('results', $this->paginate($this->Results));
        $this->set('_serialize', ['results']);
    }

    /**
     * View method
     *
     * @param string|null $id Result id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $result = $this->Results->get($id, [
            'contain' => ['Resultcategories', 'Schools', 'Classrooms', 'Students', 'Subjects']
        ]);
        $this->set('result', $result);
        $this->set('_serialize', ['result']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $result = $this->Results->newEntity();
        if ($this->request->is('post')) {
            $result = $this->Results->patchEntity($result, $this->request->data);
            if ($this->Results->save($result)) {
                $this->Flash->success(__('The result has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The result could not be saved. Please, try again.'));
            }
        }
        $resultcategories = $this->Results->Resultcategories->find('list', ['limit' => 200]);
        $schools = $this->Results->Schools->find('list', ['limit' => 200]);
        $classrooms = $this->Results->Classrooms->find('list', ['limit' => 200]);
        $students = $this->Results->Students->find('list', ['limit' => 200]);
        $subjects = $this->Results->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('result', 'resultcategories', 'schools', 'classrooms', 'students', 'subjects'));
        $this->set('_serialize', ['result']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Result id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $result = $this->Results->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $result = $this->Results->patchEntity($result, $this->request->data);
            if ($this->Results->save($result)) {
                $this->Flash->success(__('The result has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The result could not be saved. Please, try again.'));
            }
        }
        $resultcategories = $this->Results->Resultcategories->find('list', ['limit' => 200]);
        $schools = $this->Results->Schools->find('list', ['limit' => 200]);
        $classrooms = $this->Results->Classrooms->find('list', ['limit' => 200]);
        $students = $this->Results->Students->find('list', ['limit' => 200]);
        $subjects = $this->Results->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('result', 'resultcategories', 'schools', 'classrooms', 'students', 'subjects'));
        $this->set('_serialize', ['result']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Result id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $result = $this->Results->get($id);
        if ($this->Results->delete($result)) {
            $this->Flash->success(__('The result has been deleted.'));
        } else {
            $this->Flash->error(__('The result could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
