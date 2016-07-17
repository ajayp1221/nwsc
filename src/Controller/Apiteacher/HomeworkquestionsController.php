<?php
namespace App\Controller\Apiteacher;

use App\Controller\Apiteacher\AppController;

/**
 * Homeworkquestions Controller
 *
 * @property \App\Model\Table\HomeworkquestionsTable $Homeworkquestions
 */
class HomeworkquestionsController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
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
                $result['error']=0;
                $result['msg'] = "update successfully";
            } else {
                $result['error']=1;
                $result['msg'] = "error";
            }
        }
        $homeworks = $this->Homeworkquestions->Homeworks->find('list', ['limit' => 200]);
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
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
                $result['error']=0;
                $result['msg'] = "update successfully";
            } else {
                $result['error']=1;
                $result['msg'] = "error";
            }
        }
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
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
            $result['error']=0;
            $result['msg'] = "remove successfully";
        } else {
            $result['error']=1;
            $result['msg'] = "sorry something went wrong please try again";
        }
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
}
