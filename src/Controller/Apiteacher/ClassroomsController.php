<?php
namespace App\Controller\Apiteacher;

use App\Controller\Apiteacher\AppController;

/**
 * Classrooms Controller
 *
 * @property \App\Model\Table\ClassroomsTable $Classrooms
 */
class ClassroomsController extends AppController
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
        $result = $this->Classrooms->find()->hydrate(false)
                ->select(['id','school_id','name','section'])
                ->where(['school_id' => $this->request->query['scid'],'status' => 1])
                ->toArray();
        if(!$result){
            $result = "";
        }
        $this->set('result', $result);
        $this->set('_serialize', ['result']);
    }
    
    public $paginate = [
        'limit' => 10
    ];
    public function studentlist(){
        $d = $this->request->data;
//        $d['school_id'] =1;
//        $d['session'] = "2015-2016";
//        $d['classroom_id'] = "1";
        $this->rq($d);
        $res = $this->Classrooms->find()
                ->select([
                    'id','name','section'
                ])
                ->where([
                    'id' => $d['classroom_id']
                ])
                ->contain([
                    'Students' => function($q) use($d){
                        return $q->select(['id','classroom_id','first_name','last_name','image','session'])
                                ->where([
                                    'school_id'=>$d['school_id'],
                                    'session' => $d['session']
                                ])
                                ->order(['first_name' => 'asc'])
                                ->contain([
                                    'Studentattendances' => function($q1){
                                        return $q1->select(['id','student_id','date','attendance'])
                                                ->where(['date' => date('d-m-Y')])
                                                ->order(['id' => 'desc']);
                                    }
                                ]);
                    }
                ])->first();
                $result = $res->students;
        $this->set('result', $result);
        $this->set('_serialize', ['result']);
    }
}
