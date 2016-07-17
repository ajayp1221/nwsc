<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Homeworkquestions Controller
 *
 * @property \App\Model\Table\HomeworkquestionsTable $Homeworkquestions
 */
class HomeworkquestionsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Homeworks']
        ];
        $this->set('homeworkquestions', $this->paginate($this->Homeworkquestions));
        $this->set('_serialize', ['homeworkquestions']);
    }

    /**
     * View method
     *
     * @param string|null $id Homeworkquestion id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $homeworkquestion = $this->Homeworkquestions->get($id, [
            'contain' => ['Homeworks']
        ]);
        $this->set('homeworkquestion', $homeworkquestion);
        $this->set('_serialize', ['homeworkquestion']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $homeworkquestion = $this->Homeworkquestions->newEntity();
        if ($this->request->is('post')) {
            $homeworkquestion = $this->Homeworkquestions->patchEntity($homeworkquestion, $this->request->data);
            if ($this->Homeworkquestions->save($homeworkquestion)) {
                $this->Flash->success(__('The homeworkquestion has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The homeworkquestion could not be saved. Please, try again.'));
            }
        }
        $homeworks = $this->Homeworkquestions->Homeworks->find('list', ['limit' => 200]);
        $this->set(compact('homeworkquestion', 'homeworks'));
        $this->set('_serialize', ['homeworkquestion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Homeworkquestion id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $homeworkquestion = $this->Homeworkquestions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $homeworkquestion = $this->Homeworkquestions->patchEntity($homeworkquestion, $this->request->data);
            if ($this->Homeworkquestions->save($homeworkquestion)) {
                $this->Flash->success(__('The homeworkquestion has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The homeworkquestion could not be saved. Please, try again.'));
            }
        }
        $homeworks = $this->Homeworkquestions->Homeworks->find('list', ['limit' => 200]);
        $this->set(compact('homeworkquestion', 'homeworks'));
        $this->set('_serialize', ['homeworkquestion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Homeworkquestion id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $homeworkquestion = $this->Homeworkquestions->get($id);
        if ($this->Homeworkquestions->delete($homeworkquestion)) {
            $this->Flash->success(__('The homeworkquestion has been deleted.'));
        } else {
            $this->Flash->error(__('The homeworkquestion could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
