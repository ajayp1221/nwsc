<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Subjects Controller
 *
 * @property \App\Model\Table\SubjectsTable $Subjects
 * @property \App\Model\Table\MobilelocalsTable $Mobilelocals
 */
class SubjectsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('subjects', $this->paginate($this->Subjects));
        $this->set('_serialize', ['subjects']);
    }

    /**
     * View method
     *
     * @param string|null $id Subject id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subject = $this->Subjects->get($id, [
            'contain' => ['Results', 'Timetables']
        ]);
        $this->set('subject', $subject);
        $this->set('_serialize', ['subject']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subject = $this->Subjects->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['status'] = 1;
            $this->request->data['school_id'] = $this->Cookie->read('selectedSchool')['id'];
            $subject = $this->Subjects->patchEntity($subject, $this->request->data);
            if ($this->Subjects->save($subject)) {
                $this->loadModel('Mobilelocals');
                $this->Mobilelocals->updateAll(['value' => 1], [
                    'school_id' => $this->Cookie->read('selectedSchool')['id'],
                    'model_name' => 'Subjects'
                ]);
                $this->Flash->success(__('The subject has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The subject could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('subject'));
        $this->set('_serialize', ['subject']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Subject id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subject = $this->Subjects->findBySlug($id)->firstOrFail();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subject = $this->Subjects->patchEntity($subject, $this->request->data);
            if ($this->Subjects->save($subject)) {
                $this->loadModel('Mobilelocals');
                $this->Mobilelocals->updateAll(['value' => 1], [
                    'school_id' => $this->Cookie->read('selectedSchool')['id'],
                    'model_name' => 'Subjects'
                ]);
                $this->Flash->success(__('The subject has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The subject could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('subject'));
        $this->set('_serialize', ['subject']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Subject id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subject = $this->Subjects->get($id);
        if ($this->Subjects->delete($subject)) {
            $this->Flash->success(__('The subject has been deleted.'));
        } else {
            $this->Flash->error(__('The subject could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
