<?php
namespace App\Controller\Teacher;

use App\Controller\Teacher\AppController;

/**
 * Homeworks Controller
 *
 * @property \App\Model\Table\HomeworksTable $Homeworks
 */
class HomeworksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $classrooms = $this->Homeworks->Classrooms->find('list', ['keyField' => 'id','valueField' => 'class_name'])
                ->where(['school_id' =>$this->Auth->user('school_id')]);
        $subjects = $this->Homeworks->Subjects->find('list', ['keyField' => 'id','valueField' => 'name'])
                ->where(['school_id' =>$this->Auth->user('school_id')]);
        $this->set(compact('classrooms','subjects'));
        if($this->request->is(['post','put'])){
            $d = $this->request->data;
            $classrooms = $this->Homeworks->Classrooms->find()->where(['id' => $d['classrooms']])->first();
            $subjects = $this->Homeworks->Subjects->find()->where(['id' => $d['subjects']])->first();
            $url = "$classrooms->slug/$subjects->slug";
            return $this->redirect(['action'=>"add",$url]);
        }
        $this->set('_serialize', ['homeworks']);
    }

    /**
     * View method
     *
     * @param string|null $id Homework id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $homework = $this->Homeworks->findBySlug($slug, [
            'contain' => (['Homeworkquestions'])
        ])->firstOrFail();
        $this->set('homework', $homework);
        $this->set('_serialize', ['homework']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($cSlug = null,$subSlug = NULL)
    {
        $subject = $this->Homeworks->Subjects->find()
                
                ->select(['id'])
                ->where(['slug' => $subSlug])
                ->first();
        $classroom = $this->Homeworks->Classrooms->find()
                ->select(['id'])
                ->where(['Classrooms.slug' => $cSlug])->first();
        $homework = $this->Homeworks->newEntity();
        if ($this->request->is('post')) {
            $d = $this->request->data;
            $d['school_id'] = $this->Auth->user('school_id');
            $d['session'] = $this->Auth->user('session');
            $d['teacher_id'] = $this->Auth->user('id');
            $d['subject_id'] = $subject->id;
            $d['classroom_id'] = $classroom->id;
            $d['status'] = 1;
            foreach($d['questions'] as $h){
                if($h['question']){
                    $homeworkquestion[] =  $h;
                }
            }
            unset($d['questions']);
            $d['homeworkquestions'] = $homeworkquestion;
            $homework = $this->Homeworks->patchEntity($homework, $d);
            if ($this->Homeworks->save($homework)) {
                $this->Flash->success(__('The homework has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The homework could not be saved. Please, try again.'));
            }
        }
        $subjects = $this->Homeworks->Subjects->find('list', ['limit' => 200]);
        $classrooms = $this->Homeworks->Classrooms->find('list', ['keyField' => 'id','valueField' => 'class_name']);
        $teachers = $this->Homeworks->Teachers->find('list', ['limit' => 200]);
        $this->set(compact('homework', 'schools', 'subjects', 'classrooms', 'teachers'));
        $this->set('_serialize', ['homework']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Homework id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $homework = $this->Homeworks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $homework = $this->Homeworks->patchEntity($homework, $this->request->data);
            if ($this->Homeworks->save($homework)) {
                $this->Flash->success(__('The homework has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The homework could not be saved. Please, try again.'));
            }
        }
        $schools = $this->Homeworks->Schools->find('list', ['limit' => 200]);
        $subjects = $this->Homeworks->Subjects->find('list', ['limit' => 200]);
        $classrooms = $this->Homeworks->Classrooms->find('list', ['limit' => 200]);
        $teachers = $this->Homeworks->Teachers->find('list', ['limit' => 200]);
        $this->set(compact('homework', 'schools', 'subjects', 'classrooms', 'teachers'));
        $this->set('_serialize', ['homework']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Homework id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $homework = $this->Homeworks->get($id);
        if ($this->Homeworks->delete($homework)) {
            $this->Flash->success(__('The homework has been deleted.'));
        } else {
            $this->Flash->error(__('The homework could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
