<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

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
            'contain' => ['Classrooms', 'Schoolfeeothercharges']
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
            $d = $this->request->data;
            $d['status'] = 1;
            $d['school_id'] = $this->Cookie->read('selectedSchool')['id'];
            $d['session'] = $this->Cookie->read('selectedSchool')['session'];
            foreach($d['schoolfeeothercharge'] as $aa){
                if($aa['extra_charges']){
                    $d['schoolfeeothercharges'][] = $aa;
                }
            }
            unset($d['schoolfeeothercharge']);
            $schoolfee = $this->Schoolfees->patchEntity($schoolfee, $d);
            if ($this->Schoolfees->save($schoolfee)) {
                $this->Flash->success(__('The schoolfee has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The schoolfee could not be saved. Please, try again.'));
            }
        }
        $classrooms = $this->Schoolfees->Classrooms->find('list', ['keyField' => 'id','valueField'=>'class_name'])->where([
            'id' => $this->Cookie->read('selectedSchool')['id']
        ]);
        $this->set(compact('schoolfee', 'classrooms'));
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
        $schoolfee = $this->Schoolfees->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $d = $this->request->data;
            $d['status'] = 1;
            $d['school_id'] = $this->Cookie->read('selectedSchool')['school_id'];
            $d['session'] = $this->Cookie->read('selectedSchool')['session'];
            $schoolfee = $this->Schoolfees->patchEntity($schoolfee, $d);
            if ($this->Schoolfees->save($schoolfee)) {
                $this->Flash->success(__('The schoolfee has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The schoolfee could not be saved. Please, try again.'));
            }
        }
        $classrooms = $this->Schoolfees->Classrooms->find('list', ['keyField' => 'id','valueField'=>'class_name'])->where([
            'id' => $this->Cookie->read('selectedSchool')['id']
        ]);
        $this->set(compact('schoolfee', 'classrooms'));
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
