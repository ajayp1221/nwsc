<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Mailer\Email;

/**
 * Teachers Controller
 *
 * @property \App\Model\Table\TeachersTable $Teachers
 */
class TeachersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $query = $this->Teachers->find()
                ->contain(['Schools', 'Cities', 'States', 'Countries'])
                ->where(['school_id' => $this->Cookie->read('selectedSchool')['id']]);
        $this->set('teachers', $this->paginate($query));
        $this->set('_serialize', ['teachers']);
    }

    /**
     * View method
     *
     * @param string|null $id Teacher id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $teacher = $this->Teachers->findBySlug($slug)
            ->contain([
                'Schools', 'Cities', 'States', 'Countries'
            ])
            ->firstOrFail();
        $this->set('teacher', $teacher);
        $this->set('_serialize', ['teacher']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $teacher = $this->Teachers->newEntity();
        if ($this->request->is('post')) {
            $d = $this->request->data;
            $d['school_id'] = $this->Cookie->read('selectedSchool')['id'];
            $d['session'] = $this->Cookie->read('selectedSchool')['session'];
            $d['password'] = 123456;
            $d['app_pwd'] = 123456;
            $d['status'] = 1;
            $teacher = $this->Teachers->patchEntity($teacher, $d);
            $message ="Welcome to SCHOOLSCLUB. Email" .$d['Email'].", Password  ".$d['app_pwd'];
            $email = new Email('default');
            $email->from(['ajayp944@gmail.com' => 'School Club'])->to($d['email'])->subject('Welcome In SchoolsClub')->send($message);
            if ($this->Teachers->save($teacher)) {
                $this->Flash->success(__('The teacher has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The teacher could not be saved. Please, try again.'));
            }
        }
        $schools = $this->Teachers->Schools->find('list', ['limit' => 200]);
        $cities = $this->Teachers->Cities->find('list', ['limit' => 200]);
        $states = $this->Teachers->States->find('list', ['limit' => 200]);
        $countries = $this->Teachers->Countries->find('list', ['limit' => 200]);
        $classrooms = $this->Teachers->Classrooms->find('list', ['limit' => 200]);
        $this->set(compact('teacher', 'schools', 'areas','cities', 'states', 'countries', 'classrooms'));
        $this->set('_serialize', ['teacher']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Teacher id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($slug = null)
    {
        \Cake\Core\Configure::write('debug',FALSE);
        $teacher = $this->Teachers->findBySlug($slug)->contain(['Classrooms'])->firstOrFail();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $teacher = $this->Teachers->patchEntity($teacher, $this->request->data);
            if ($this->Teachers->save($teacher)) {
                $this->Flash->success(__('The teacher has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The teacher could not be saved. Please, try again.'));
            }
        }
        $schools = $this->Teachers->Schools->find('list', ['limit' => 200]);
        $areas = $this->Teachers->Areas->find('list', ['limit' => 200]);
        $cities = $this->Teachers->Cities->find('list', ['limit' => 200]);
        $states = $this->Teachers->States->find('list', ['limit' => 200]);
        $countries = $this->Teachers->Countries->find('list', ['limit' => 200]);
        $classrooms = $this->Teachers->Classrooms->find('list', ['limit' => 200]);
        $this->set(compact('teacher','areas', 'schools', 'cities', 'states', 'countries', 'classrooms'));
        $this->set('_serialize', ['teacher']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Teacher id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $teacher = $this->Teachers->get($id);
        if ($this->Teachers->delete($teacher)) {
            $this->Flash->success(__('The teacher has been deleted.'));
        } else {
            $this->Flash->error(__('The teacher could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
