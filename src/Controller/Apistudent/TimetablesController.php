<?php
namespace App\Controller\Apistudent;

use App\Controller\Apistudent\AppController;

/**
 * Timetables Controller
 *
 * @property \App\Model\Table\TimetablesTable $Timetables
 */
class TimetablesController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }

    public function index(){
//        \Cake\Core\Configure::write('debug',FALSE);
        $this->request->allowMethod(['post', 'put']);
//        $this->rq($this->request->data);
//        $this->request->data['school_id'] =  2;
//        $this->request->data['session'] = "2008-2009";
//        $this->request->data['classroom_id']  = 1;
        $this->rq($this->request->data);
        $result = $this->Timetables->find()
                ->contain([
                    'Subjects' => function($q){return $q->select(['id','name']);},
                ])
                ->where([
                    'Timetables.school_id' => $this->request->data['school_id'],
                    'Timetables.session' => $this->request->data['session'],
                    'Timetables.classroom_id' => $this->request->data['classroom_id'],
                    'Timetables.status' => 1
                ])
                ->select(['period_no','period_time','days'])
                ->order(['period_time' => "asc"])
                ->toArray();
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
         
    }
}
