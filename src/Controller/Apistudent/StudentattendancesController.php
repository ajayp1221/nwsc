<?php
namespace App\Controller\Apistudent;

use App\Controller\Apistudent\AppController;

/**
 * Studentattendances Controller
 *
 * @property \App\Model\Table\StudentattendancesTable $Studentattendances
 */
class StudentattendancesController extends AppController
{
    
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }
    
    public function index(){
        ini_set('memory_limit', '-1');  
        ini_set('max_execution_time', -1);
//        $d['school_id'] =  1;
//        $d['session'] = "2015-2016";
//        $d['classroom_id']  = 1;
//        $d['student_id'] = 1;
//        $d['month'] = '03';
        $this->request->allowMethod(['post', 'put']);
        $d = $this->request->data;
        $this->rq($d);
        $result = $this->Studentattendances->find()
                ->where([
                    'Studentattendances.school_id' => $d['school_id'],
                    'Studentattendances.session' => $d['session'],
                    'Studentattendances.classroom_id' => $d['classroom_id'],
                    'Studentattendances.student_id' => $d['student_id'],
                    "MONTH(str_to_date(`date`,'%d-%m-%Y'))" => $d['month']
                ])
                ->select(['id','attendance','session','date'])
                ->order(['Studentattendances.created' => 'asc'])->toArray();
        $this->set('result', $result);
        $this->set('_serialize', ['result']);
    }
    
    public function startmonth(){
        $this->request->allowMethod(['post', 'put']);
        $d = $this->request->data;
        $this->rq($d);
        $result = $this->Studentattendances->find()
            ->select('date')
            ->where([
                'school_id' => $d['school_id'],
                'classroom_id' => $d['classroom_id'],
                'session' => $d['session']
            ])
            ->first();
        $this->set('result', $result);
        $this->set('_serialize', ['result']);
    }
}
