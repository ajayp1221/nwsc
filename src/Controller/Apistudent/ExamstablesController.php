<?php
namespace App\Controller\Apistudent;

use App\Controller\Apistudent\AppController;

/**
 * Examstables Controller
 *
 * @property \App\Model\Table\ExamstablesTable $Examstables
 */
class ExamstablesController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }

    public function index(){
        $d = $this->request->data;
//        $d['session'] = "2015-2016";
//        $d['school_id'] = 1;
//        $d['classroom_id'] = 1;
        
        $this->rq($d);
        $result = $this->Examstables->find()->where([
            'Examstables.session' => $d['session'],
            'Examstables.school_id' => $d['school_id'],
            'Examstables.classroom_id' => $d['classroom_id'],
            'Examstables.status' => 1
        ])
        ->select([
            'id','exam_name','on_date','time'
        ])
        ->contain([
            'Subjects' => function($q){
                return $q->select(['id','name']);
            },
            'Classrooms' => function($q){
                return $q->select(['id','name','section']);
            }
        ])
        ->toArray();
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
}
