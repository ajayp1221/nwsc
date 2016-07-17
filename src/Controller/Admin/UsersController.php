<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Mailer\Email;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Areas', 'Cities', 'States', 'Countries']
        ];
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $user = $this->Users->find()->contain([
            'Areas', 'Cities', 'States', 'Countries'
        ])->where([
            'Users.slug' => $slug
        ])->contain(['Schools'])->first();
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }
    
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $d=$this->request->data;
            $d['ownerid'] = $this->Auth->user('id');
            $d['status'] = 1;
            $d['password'] = 123456;
            $user = $this->Users->patchEntity($user, $d);
            if ($this->Users->save($user)) {
                $email = new Email('default');
                $message = "Welecome to SchoolsClub Email - ".$d['email'].", Password - 123456";
                $response = $email->from(["info@schoolsclub.in" => "SchoolsClub"])->to($d['email'])->subject('Welcome to SchoolsClub')
                        ->send($message); 
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $areas = $this->Users->Areas->find('list', ['limit' => 200]);
        $cities = $this->Users->Cities->find('list', ['limit' => 200]);
        $states = $this->Users->States->find('list', ['limit' => 200]);
        $countries = $this->Users->Countries->find('list', ['limit' => 200]);
        $this->set(compact('user', 'areas', 'cities', 'states', 'countries'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($slug = null)
    {
        $user = $this->Users->find()->where(['slug' => $slug])->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $areas = $this->Users->Areas->find('list', ['limit' => 200]);
        $cities = $this->Users->Cities->find('list', ['limit' => 200]);
        $states = $this->Users->States->find('list', ['limit' => 200]);
        $countries = $this->Users->Countries->find('list', ['limit' => 200]);
        $this->set(compact('user', 'areas', 'cities', 'states', 'countries'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * Login method
     */
    
    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                if(empty($this->Cookie->read('selectedSchool'))){
                    $this->loadModel('Schools');
                    $schoolName = $this->Schools->find()->select(['name','id'])->where(['user_id' => $this->Auth->user('id')])->first();
                    $this->Cookie->write('selectedSchool', $schoolName['id'], true, "2 week");
                }
                if ($this->request->data['remember'] == "1") {
                    $cookie = array();
                    $cookie['email'] = $this->request->data['email'];
                    $cookie['password'] = $this->request->data['password'];
                    $this->Cookie->write('remember', $cookie, true, "1 week");
                    unset($this->request->data['remember']);
                }
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('Username or password is incorrect'));
            }
        } else {
            if (($this->Cookie->read('remember'))) {
                if(empty($this->Cookie->read('selectedSchool'))){
                    $schoolName = $this->Schools->find()->select(['name','id'])->where(['user_id' => $this->Auth->user('id')])->first();
                    $this->Cookie->write('selectedSchool', $schoolName['id'], true, "2 week");
                }
                $this->request->data = $this->Cookie->read('remember');
                $user = $this->Auth->identify();
                if ($user) {
                    $this->Auth->setUser($user);
                    return $this->redirect($this->Auth->redirectUrl());
                } else {
                    $this->Cookie->destroy('remember');
                    $this->Flash->success('Invalid cookie');
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
        }
    }
    
    /**
     * Logout method
     */
    public function logout()
    {
        $this->redirect($this->Auth->logout());
        return $this->redirect(['controller' => 'users','action' => 'index']);
    }
}
