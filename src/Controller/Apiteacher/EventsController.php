<?php
namespace App\Controller\Apiteacher;

use App\Controller\Apiteacher\AppController;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 */
class EventsController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $d = $this->request->data;
        $this->rq($d);
        $currentDate = date('d/m/Y');
        $event = $this->Events->find()
                ->select([
                    'id','event_type','event_name','start_time','end_time','description'
                ])
                ->where([
                    'status' => 1,
                    'teacher_id' => $d['teacher_id'],
                    'school_id' => $d['school_id'],
                    'session' => $d['session'],
                    "(select date_format(str_to_date(end_time, '%d/%m/%Y'), '%d/%m/%Y')) >="=> $currentDate
                ])
                ->order(['id'=>'desc']);
        $result = $this->paginate($event);
        $this->set('result', $result);
        $this->set('_serialize', ['result']);
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['Schools', 'Teachers', 'Classrooms']
        ]);
        $this->set('event', $event);
        $this->set('_serialize', ['event']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $event = $this->Events->newEntity();
        if ($this->request->is('post')) {
            $this->rq($this->request->data);
            $this->request->data['status'] = 1;
            $event = $this->Events->patchEntity($event, $this->request->data);
            if ($this->Events->save($event)) {
                $result['error'] = 0;
                $result['msg'] = "sussess";
            } else {
                $result['error'] = 1;
                $result['msg'] = "Something went wrong please try again";
            }
        }
        $this->set('result', $result);
        $this->set('_serialize', ['result']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->data);
            if ($this->Events->save($event)) {
                $result['error'] = 0;
                $result['msg'] = "sussess";
            } else {
                $result['error'] = 1;
                $result['msg'] = "Something went wrong please try again";
            }
        }
        $this->set('result', $result);
        $this->set('_serialize', ['result']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
           $result['error'] = 0;
            $result['msg'] = "sussess";
        } else {
            $result['error'] = 1;
            $result['msg'] = "Something went wrong please try again";
        }
        $this->set('result', $result);
        $this->set('_serialize', ['result']);
    }
}
