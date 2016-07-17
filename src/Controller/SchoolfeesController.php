<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Schoolfees Controller
 *
 * @property \App\Model\Table\SchoolfeesTable $Schoolfees
 */
class SchoolfeesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Schools', 'Classrooms']
        ];
        $schoolfees = $this->paginate($this->Schoolfees);

        $this->set(compact('schoolfees'));
        $this->set('_serialize', ['schoolfees']);
    }

    /**
     * View method
     *
     * @param string|null $id Schoolfee id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $schoolfee = $this->Schoolfees->get($id, [
            'contain' => ['Schools', 'Classrooms', 'Students', 'Schoolfeeothercharges', 'Studentfees']
        ]);

        $this->set('schoolfee', $schoolfee);
        $this->set('_serialize', ['schoolfee']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $schoolfee = $this->Schoolfees->newEntity();
        if ($this->request->is('post')) {
            $schoolfee = $this->Schoolfees->patchEntity($schoolfee, $this->request->data);
            if ($this->Schoolfees->save($schoolfee)) {
                $this->Flash->success(__('The schoolfee has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The schoolfee could not be saved. Please, try again.'));
            }
        }
        $schools = $this->Schoolfees->Schools->find('list', ['limit' => 200]);
        $classrooms = $this->Schoolfees->Classrooms->find('list', ['limit' => 200]);
        $students = $this->Schoolfees->Students->find('list', ['limit' => 200]);
        $this->set(compact('schoolfee', 'schools', 'classrooms', 'students'));
        $this->set('_serialize', ['schoolfee']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Schoolfee id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $schoolfee = $this->Schoolfees->get($id, [
            'contain' => ['Students']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $schoolfee = $this->Schoolfees->patchEntity($schoolfee, $this->request->data);
            if ($this->Schoolfees->save($schoolfee)) {
                $this->Flash->success(__('The schoolfee has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The schoolfee could not be saved. Please, try again.'));
            }
        }
        $schools = $this->Schoolfees->Schools->find('list', ['limit' => 200]);
        $classrooms = $this->Schoolfees->Classrooms->find('list', ['limit' => 200]);
        $students = $this->Schoolfees->Students->find('list', ['limit' => 200]);
        $this->set(compact('schoolfee', 'schools', 'classrooms', 'students'));
        $this->set('_serialize', ['schoolfee']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Schoolfee id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $schoolfee = $this->Schoolfees->get($id);
        if ($this->Schoolfees->delete($schoolfee)) {
            $this->Flash->success(__('The schoolfee has been deleted.'));
        } else {
            $this->Flash->error(__('The schoolfee could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
