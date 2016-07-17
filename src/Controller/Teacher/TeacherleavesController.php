<?php
namespace App\Controller\Teacher;

use App\Controller\Teacher\AppController;

/**
 * Teacherleaves Controller
 *
 * @property \App\Model\Table\TeacherleavesTable $Teacherleaves
 */
class TeacherleavesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $qry = $this->Teacherleaves->find()->where(['teacher_id' => $this->Auth->user('id'),'session' => $this->Auth->user('session')]);
        $teacherleaves = $this->paginate($qry);

        $this->set(compact('teacherleaves'));
        $this->set('_serialize', ['teacherleaves']);
    }

    /**
     * View method
     *
     * @param string|null $id Teacherleave id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $teacherleave = $this->Teacherleaves->get($id, [
            'contain' => ['Teachers']
        ]);

        $this->set('teacherleave', $teacherleave);
        $this->set('_serialize', ['teacherleave']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $teacherleave = $this->Teacherleaves->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['status'] = 1;
            $this->request->data['session'] = $this->Auth->user('session');
            $this->request->data['teacher_id'] = $this->Auth->user('id');
            $this->request->data['school_id'] = $this->Auth->user('school_id');
            $teacherleave = $this->Teacherleaves->patchEntity($teacherleave, $this->request->data);
            if ($this->Teacherleaves->save($teacherleave)) {
                $this->Flash->success(__('Leave request sent successfully'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Something went wrong please try again.'));
            }
        }
        $teachers = $this->Teacherleaves->Teachers->find('list', ['limit' => 200]);
        $this->set(compact('teacherleave', 'teachers'));
        $this->set('_serialize', ['teacherleave']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Teacherleave id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $teacherleave = $this->Teacherleaves->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $teacherleave = $this->Teacherleaves->patchEntity($teacherleave, $this->request->data);
            if ($this->Teacherleaves->save($teacherleave)) {
                $this->Flash->success(__('The teacherleave has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The teacherleave could not be saved. Please, try again.'));
            }
        }
        $teachers = $this->Teacherleaves->Teachers->find('list', ['limit' => 200]);
        $this->set(compact('teacherleave', 'teachers'));
        $this->set('_serialize', ['teacherleave']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Teacherleave id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $teacherleave = $this->Teacherleaves->get($id);
        if ($this->Teacherleaves->delete($teacherleave)) {
            $this->Flash->success(__('The teacherleave has been deleted.'));
        } else {
            $this->Flash->error(__('The teacherleave could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
