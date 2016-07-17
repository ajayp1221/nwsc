<?php
namespace App\Controller\Teacher;

use App\Controller\Teacher\AppController;

/**
 * Results Controller
 *
 * @property \App\Model\Table\ResultsTable $Results
 */
class ResultsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index(){
        $classrooms = $this->Results->Classrooms->find('list',['keyField' => 'id','valueField' => 'class_name'])->where([
            'school_id' => $this->Auth->user('school_id')
        ]);
        $resultcategories = $this->Results->Resultcategories->find('list',['keyField' => 'id','valueField' => 'name'])->where([
            'school_id' => $this->Auth->user('school_id'),
            'session' => $this->Auth->user('session')
        ]);
        $subjects = $this->Results->Subjects->find('list',['keyField' => 'id','valueField' => 'name'])->where([
            'school_id' => $this->Auth->user('school_id')
        ]);
        
        if($this->request->is(['post','put'])){
            $d = $this->request->data;
            $classrooms = $this->Results->Classrooms->find()->where(['id' => $d['classrooms']])->first();
            $resultcategories = $this->Results->Resultcategories->find()->where(['id' => $d['resultcategories']])->first();
            $subjects = $this->Results->Subjects->find()->where(['id' => $d['subjects']])->first();
            $url = "teacher".DS."students".DS."add-result-by-class".DS."$classrooms->slug".DS."$resultcategories->slug".DS."$subjects->slug";
            $url = 'http://schoolsclub.in'.DS.$url;
            
            return $this->redirect($url);
        }
        $this->set(compact('classrooms', 'resultcategories', 'subjects'));
        $this->set('_serialize', ['student']);
    }

    /**
     * View method
     *
     * @param string|null $id Result id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $result = $this->Results->get($id, [
            'contain' => ['Resultcategories', 'Schools', 'Classrooms', 'Students', 'Subjects']
        ]);

        $this->set('result', $result);
        $this->set('_serialize', ['result']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($cSlug = null)
    {
        $classId = $this->Results->Classrooms->find()->hydrate(false)->select(['id'])->where(['slug' => $cSlug])->first();
        $result = $this->Results->newEntity();
        if ($this->request->is('post')) {
            $d = $this->request->data;
            $d['school_id'] = $this->Auth->user('school_id');
            $d['status'] = 1;
            $d['session'] = $this->Auth->user('session');
            $d['classroom_id'] = $classId['id'];
            $result = $this->Results->patchEntity($result, $d);
            if ($this->Results->save($result)) {
                $this->Flash->success(__('The result has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The result could not be saved. Please, try again.'));
            }
        }
        $resultcategories = $this->Results->Resultcategories->find('list', ['limit' => 200])->where([
            'school_id' => $this->Auth->user('school_id'),
            'session' => $this->Auth->user('session')
        ]);
        $students = $this->Results->Students->find('list', ['keyField' => 'id','valueField' => 'full_name'])->where([
            'school_id' => $this->Auth->user('school_id'),
            'session' => $this->Auth->user('session'),
            'classroom_id' => $classId['id']
        ])
        ->order(['first_name' => 'asc','last_name' => 'asc']);
        $subjects = $this->Results->Subjects->find('list', ['limit' => 200])->where([
            'school_id' => $this->Auth->user('school_id')
        ]);
        $this->set(compact('result', 'resultcategories', 'students', 'subjects'));
        $this->set('_serialize', ['result']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Result id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $result = $this->Results->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $result = $this->Results->patchEntity($result, $this->request->data);
            if ($this->Results->save($result)) {
                $this->Flash->success(__('The result has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The result could not be saved. Please, try again.'));
            }
        }
        $resultcategories = $this->Results->Resultcategories->find('list', ['limit' => 200]);
        $schools = $this->Results->Schools->find('list', ['limit' => 200]);
        $classrooms = $this->Results->Classrooms->find('list', ['limit' => 200]);
        $students = $this->Results->Students->find('list', ['limit' => 200]);
        $subjects = $this->Results->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('result', 'resultcategories', 'schools', 'classrooms', 'students', 'subjects'));
        $this->set('_serialize', ['result']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Result id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $result = $this->Results->get($id);
        if ($this->Results->delete($result)) {
            $this->Flash->success(__('The result has been deleted.'));
        } else {
            $this->Flash->error(__('The result could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
