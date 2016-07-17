<?php
namespace App\Controller\Apiteacher;

use App\Controller\Apiteacher\AppController;

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
/*
 * Teacher Time Table List
 */
    public function index(){
        \Cake\Core\Configure::write('debug',FALSE);
        $this->request->allowMethod(['post', 'put']);
        $d = $this->request->data;
        $this->rq($d);
        $result = $this->Timetables->find()
                ->contain([
                    'Subjects' => function($q){return $q->select(['name']);},
                    'Classrooms' => function($q){return $q->select(['id','name','section']);}
                ])
                ->where([
                    'Timetables.school_id' => $d['school_id'],
                    'Timetables.session' => $d['session'],
                    'Timetables.teacher_id' => $d['teacher_id'],
                    'Timetables.status' => 1
                ])
                ->select(['period_no','period_time','days'])
                ->order(['period_time' => "asc"])
                ->toArray();
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
}
