<?php
namespace App\Controller\Apistudent;

use App\Controller\Apistudent\AppController;

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
        $currentDate = date('m/d/Y H:i');
        $event = $this->Events->find()
                ->select([
                    'id','event_type','event_name','start_time','end_time','description'
                ])
                ->where([
                    'status' => 1,
                    'school_id' => $d['school_id'],
                    'session' => $d['session'],
                    "(select date_format(str_to_date(end_time, '%m/%d/%Y'), '%m/%d/%Y')) >="=> $currentDate
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
}
