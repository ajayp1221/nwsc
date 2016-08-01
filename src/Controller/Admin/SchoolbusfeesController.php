<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Schoolbusfees Controller
 *
 * @property \App\Model\Table\SchoolbusfeesTable $Schoolbusfees
 */
class SchoolbusfeesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $schoolbusfees = $this->paginate($this->Schoolbusfees->find()->where([
            'school_id' => $this->Cookie->read('selectedSchool')['id'],
            'session' => $this->Cookie->read('selectedSchool')['session']
        ]));

        $this->set(compact('schoolbusfees'));
        $this->set('_serialize', ['schoolbusfees']);
    }

    /**
     * View method
     *
     * @param string|null $id Schoolbusfee id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $schoolbusfee = $this->Schoolbusfees->get($id, [
            'contain' => ['Schools']
        ]);

        $this->set('schoolbusfee', $schoolbusfee);
        $this->set('_serialize', ['schoolbusfee']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $schoolbusfee = $this->Schoolbusfees->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['school_id'] =  $this->Cookie->read('selectedSchool')['id'];
            $this->request->data['session'] = $this->Cookie->read('selectedSchool')['session'];
            $this->request->data['status'] = 1;
            $this->request->data['deleted'] = 0;
            $schoolbusfee = $this->Schoolbusfees->patchEntity($schoolbusfee, $this->request->data);
            if ($this->Schoolbusfees->save($schoolbusfee)) {
                $this->Flash->success(__('The schoolbusfee has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The schoolbusfee could not be saved. Please, try again.'));
            }
        }
        $schools = $this->Schoolbusfees->Schools->find('list', ['limit' => 200]);
        $this->set(compact('schoolbusfee', 'schools'));
        $this->set('_serialize', ['schoolbusfee']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Schoolbusfee id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $schoolbusfee = $this->Schoolbusfees->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $schoolbusfee = $this->Schoolbusfees->patchEntity($schoolbusfee, $this->request->data);
            if ($this->Schoolbusfees->save($schoolbusfee)) {
                $this->Flash->success(__('The schoolbusfee has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The schoolbusfee could not be saved. Please, try again.'));
            }
        }
        $schools = $this->Schoolbusfees->Schools->find('list', ['limit' => 200]);
        $this->set(compact('schoolbusfee', 'schools'));
        $this->set('_serialize', ['schoolbusfee']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Schoolbusfee id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $schoolbusfee = $this->Schoolbusfees->get($id);
        if ($this->Schoolbusfees->delete($schoolbusfee)) {
            $this->Flash->success(__('The schoolbusfee has been deleted.'));
        } else {
            $this->Flash->error(__('The schoolbusfee could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
