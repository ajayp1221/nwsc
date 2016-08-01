<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Schoolfeeothercharges Controller
 *
 * @property \App\Model\Table\SchoolfeeotherchargesTable $Schoolfeeothercharges
 */
class SchoolfeeotherchargesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Schoolfees']
        ];
        $schoolfeeothercharges = $this->paginate($this->Schoolfeeothercharges);

        $this->set(compact('schoolfeeothercharges'));
        $this->set('_serialize', ['schoolfeeothercharges']);
    }

    /**
     * View method
     *
     * @param string|null $id Schoolfeeothercharge id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $schoolfeeothercharge = $this->Schoolfeeothercharges->get($id, [
            'contain' => ['Schoolfees']
        ]);

        $this->set('schoolfeeothercharge', $schoolfeeothercharge);
        $this->set('_serialize', ['schoolfeeothercharge']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
        $schoolfeeothercharge = $this->Schoolfeeothercharges->newEntity();
        if ($this->request->is('post')) {
            $d = $this->request->data;
            
            $res = $this->Schoolfeeothercharges->Schoolfees->updateAll(['fee = fee + ' . $d['extra_charges']],['id' => $d['schoolfee_id']]);
            $schoolfeeothercharge = $this->Schoolfeeothercharges->patchEntity($schoolfeeothercharge, $d);
            if ($this->Schoolfeeothercharges->save($schoolfeeothercharge)) {
                $this->Flash->success(__('The schoolfeeothercharge has been saved.'));
                return $this->redirect(['controller'=> 'schoolfees','action' => 'view',$this->request->data['schoolfee_id']]);
            } else {
                $this->Flash->error(__('The schoolfeeothercharge could not be saved. Please, try again.'));
            }
        }
        $schoolfees = $this->Schoolfeeothercharges->Schoolfees->find('list', ['limit' => 200]);
        $this->set(compact('schoolfeeothercharge', 'schoolfees','id'));
        $this->set('_serialize', ['schoolfeeothercharge']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Schoolfeeothercharge id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $schoolfeeothercharge = $this->Schoolfeeothercharges->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $schoolfeeothercharge = $this->Schoolfeeothercharges->patchEntity($schoolfeeothercharge, $this->request->data);
            if ($this->Schoolfeeothercharges->save($schoolfeeothercharge)) {
                $this->Flash->success(__('The schoolfeeothercharge has been saved.'));
                return $this->redirect(['controller'=> 'schoolfees','action' => 'view',$schoolfeeothercharge->schoolfee_id]);
            } else {
                $this->Flash->error(__('The schoolfeeothercharge could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('schoolfeeothercharge'));
        $this->set('_serialize', ['schoolfeeothercharge']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Schoolfeeothercharge id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $schoolfeeothercharge = $this->Schoolfeeothercharges->get($id);
        if ($this->Schoolfeeothercharges->delete($schoolfeeothercharge)) {
            $this->Flash->success(__('The schoolfeeothercharge has been deleted.'));
        } else {
            $this->Flash->error(__('The schoolfeeothercharge could not be deleted. Please, try again.'));
        }
        return $this->redirect($this->referer());
    }
}
