<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Resultcategories Controller
 *
 * @property \App\Model\Table\ResultcategoriesTable $Resultcategories
 * @property \App\Model\Table\MobilelocalsTable $Mobilelocals
 */
class ResultcategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Schools']
        ];
        $this->set('resultcategories', $this->paginate($this->Resultcategories));
        $this->set('_serialize', ['resultcategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Resultcategory id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $resultcategory = $this->Resultcategories->get($id, [
            'contain' => ['Schools', 'Results']
        ]);
        $this->set('resultcategory', $resultcategory);
        $this->set('_serialize', ['resultcategory']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $resultcategory = $this->Resultcategories->newEntity();
        if ($this->request->is('post')) {
            $resultcategory = $this->Resultcategories->patchEntity($resultcategory, $this->request->data);
            if ($this->Resultcategories->save($resultcategory)) {
                $this->loadModel('Mobilelocals');
                $this->Mobilelocals->updateAll(['value' => 1], [
                    'school_id' => $this->Cookie->read('selectedSchool')['id'],
                    'model_name' => 'Resultcategories'
                ]);
                $this->Flash->success(__('The resultcategory has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The resultcategory could not be saved. Please, try again.'));
            }
        }
        $schools = $this->Resultcategories->Schools->find('list', ['limit' => 200]);
        $this->set(compact('resultcategory', 'schools'));
        $this->set('_serialize', ['resultcategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Resultcategory id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $resultcategory = $this->Resultcategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $resultcategory = $this->Resultcategories->patchEntity($resultcategory, $this->request->data);
            if ($this->Resultcategories->save($resultcategory)) {
                $this->loadModel('Mobilelocals');
                $this->Mobilelocals->updateAll(['value' => 1], [
                    'school_id' => $this->Cookie->read('selectedSchool')['id'],
                    'model_name' => 'Resultcategories'
                ]);
                $this->Flash->success(__('The resultcategory has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The resultcategory could not be saved. Please, try again.'));
            }
        }
        $schools = $this->Resultcategories->Schools->find('list', ['limit' => 200]);
        $this->set(compact('resultcategory', 'schools'));
        $this->set('_serialize', ['resultcategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Resultcategory id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $resultcategory = $this->Resultcategories->get($id);
        if ($this->Resultcategories->delete($resultcategory)) {
            $this->Flash->success(__('The resultcategory has been deleted.'));
        } else {
            $this->Flash->error(__('The resultcategory could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
