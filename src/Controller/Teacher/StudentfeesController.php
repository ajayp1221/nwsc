<?php
namespace App\Controller\Teacher;

use App\Controller\Teacher\AppController;

/**
 * Studentfees Controller
 *
 * @property \App\Model\Table\StudentfeesTable $Studentfees
 */
class StudentfeesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $studentfees = $this->paginate($this->Studentfees);

        $this->set(compact('studentfees'));
        $this->set('_serialize', ['studentfees']);
    }

    /**
     * View method
     *
     * @param string|null $id Studentfee id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($studentSlug = null)
    {
        $student = $this->Studentfees->Students->find()
                ->where(['Students.slug' => $studentSlug])
                ->contain([
                    'Studentfees' => function($q){
                        return $q->where(['session' => $this->Auth->user('session')])->order(['id'=> 'desc']);
                    },
                    'Classrooms'
                ])
                ->first();
        $this->set(compact('student'));
        $this->set('_serialize', ['student']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $studentfee = $this->Studentfees->newEntity();
        if ($this->request->is('post')) {
            $studentfee = $this->Studentfees->patchEntity($studentfee, $this->request->data);
            if ($this->Studentfees->save($studentfee)) {
                $this->Flash->success(__('The studentfee has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The studentfee could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('studentfee'));
        $this->set('_serialize', ['studentfee']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Studentfee id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $studentfee = $this->Studentfees->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $studentfee = $this->Studentfees->patchEntity($studentfee, $this->request->data);
            if ($this->Studentfees->save($studentfee)) {
                $this->Flash->success(__('The studentfee has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The studentfee could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('studentfee'));
        $this->set('_serialize', ['studentfee']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Studentfee id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $studentfee = $this->Studentfees->get($id);
        if ($this->Studentfees->delete($studentfee)) {
            $this->Flash->success(__('The studentfee has been deleted.'));
        } else {
            $this->Flash->error(__('The studentfee could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function studentsList(){
        
        $this->Studentfees->Students->find()->where([
            'classroom_id' => $this->request->query['cid']
        ]);
        
    }
}
