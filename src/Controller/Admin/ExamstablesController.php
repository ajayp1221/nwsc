<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Examstables Controller
 *
 * @property \App\Model\Table\ExamstablesTable $Examstables
 */
class ExamstablesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Schools', 'Classrooms', 'Subjects']
        ];
        $examstables = $this->paginate($this->Examstables);

        $this->set(compact('examstables'));
        $this->set('_serialize', ['examstables']);
    }

    /**
     * View method
     *
     * @param string|null $id Examstable id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $examstable = $this->Examstables->get($id, [
            'contain' => ['Schools', 'Classrooms', 'Subjects']
        ]);

        $this->set('examstable', $examstable);
        $this->set('_serialize', ['examstable']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($clSlug = null)
    {
        $classrooms = $this->Examstables->Classrooms->find()->where(['slug' => $clSlug])->first();
        $subjects = $this->Examstables->Subjects->find('list')->where(['school_id' => $this->Cookie->read('selectedSchool')['id']]);
        if ($this->request->is('post')) {
            $d = $this->request->data;
            $count = 1;
            foreach($d['subject_id'] as $subjectId){
                $data = [
                    'exam_name' => $d['exam_name'],
                    'subject_id' => $subjectId,
                    'classroom_id' => $classrooms->id,
                    'on_date' => $d['on_date'][$count],
                    'time' => $d['time'][$count],
                    'session' => $this->Cookie->read('selectedSchool')['session'],
                    'school_id' => $this->Cookie->read('selectedSchool')['id'],
                    'status' => 1
                ];
                $count++;
                
                $saveData = $this->Examstables->newEntity($data);
                $res[] = $this->Examstables->save($saveData);
            }
            $this->Flash->success(__('The examstable has been saved.'));
            return $this->redirect(['controller'=>'classrooms','action' => 'index']);
        }
        $this->set(compact('classrooms', 'subjects'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Examstable id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $examstable = $this->Examstables->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $examstable = $this->Examstables->patchEntity($examstable, $this->request->data);
            if ($this->Examstables->save($examstable)) {
                $this->Flash->success(__('The examstable has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The examstable could not be saved. Please, try again.'));
            }
        }
        $schools = $this->Examstables->Schools->find('list', ['limit' => 200]);
        $classrooms = $this->Examstables->Classrooms->find('list', ['limit' => 200]);
        $subjects = $this->Examstables->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('examstable', 'schools', 'classrooms', 'subjects'));
        $this->set('_serialize', ['examstable']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Examstable id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $examstable = $this->Examstables->get($id);
        if ($this->Examstables->delete($examstable)) {
            $this->Flash->success(__('The examstable has been deleted.'));
        } else {
            $this->Flash->error(__('The examstable could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
