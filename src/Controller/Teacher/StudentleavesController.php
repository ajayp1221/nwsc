<?php
namespace App\Controller\Teacher;

use App\Controller\Teacher\AppController;

/**
 * Studentleaves Controller
 *
 * @property \App\Model\Table\StudentleavesTable $Studentleaves
 */
class StudentleavesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($cSlug = null)
    {
        
        $classroom = $this->Studentleaves->Classrooms->find()
                ->select(['id'])
                ->where(['Classrooms.slug' => $cSlug])->first();
        $student = $this->Studentleaves->find()->where([
                    'Studentleaves.session' => $this->Auth->user('session'),
                    'Studentleaves.school_id' => $this->Auth->user('school_id'),
                    'Studentleaves.classroom_id' => $classroom->id
                ])->contain([
                    'Students' => function($q){
                        return $q->select(['id','first_name','last_name','image']);
                    }
                ])->select([
                    'id','student_id','classroom_id','session','school_id','title','reason','from_date','to_date','is_approved','created'
                ])->order(['Studentleaves.id' => 'desc']);
        $studentleaves = $this->paginate($student);

        $this->set(compact('studentleaves'));
        $this->set('_serialize', ['studentleaves']);
    }

    /**
     * View method
     *
     * @param string|null $id Studentleave id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $studentleave = $this->Studentleaves->get($id, [
            'contain' => ['Classrooms', 'Students']
        ]);

        $this->set('studentleave', $studentleave);
        $this->set('_serialize', ['studentleave']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $studentleave = $this->Studentleaves->newEntity();
        if ($this->request->is('post')) {
            $studentleave = $this->Studentleaves->patchEntity($studentleave, $this->request->data);
            if ($this->Studentleaves->save($studentleave)) {
                $this->Flash->success(__('The studentleave has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The studentleave could not be saved. Please, try again.'));
            }
        }
        $classrooms = $this->Studentleaves->Classrooms->find('list', ['limit' => 200]);
        $students = $this->Studentleaves->Students->find('list', ['limit' => 200]);
        $this->set(compact('studentleave', 'classrooms', 'students'));
        $this->set('_serialize', ['studentleave']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Studentleave id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $studentleave = $this->Studentleaves->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $studentleave = $this->Studentleaves->patchEntity($studentleave, $this->request->data);
            if ($this->Studentleaves->save($studentleave)) {
                $this->Flash->success(__('The studentleave has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The studentleave could not be saved. Please, try again.'));
            }
        }
        $classrooms = $this->Studentleaves->Classrooms->find('list', ['limit' => 200]);
        $students = $this->Studentleaves->Students->find('list', ['limit' => 200]);
        $this->set(compact('studentleave', 'classrooms', 'students'));
        $this->set('_serialize', ['studentleave']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Studentleave id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $studentleave = $this->Studentleaves->get($id);
        if ($this->Studentleaves->delete($studentleave)) {
            $this->Flash->success(__('The studentleave has been deleted.'));
        } else {
            $this->Flash->error(__('The studentleave could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
