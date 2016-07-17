<?php
namespace App\Controller\Apistudent;

use App\Controller\Apistudent\AppController;

/**
 * Results Controller
 *
 * @property \App\Model\Table\ResultsTable $Results
 */
class ResultsController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }
    
    public function index(){
        $this->request->allowMethod(['post', 'put']);
//        $this->request->data['resultcategory_id'] = 0;
//        $this->request->data['classroom_id'] = 1;
//        $this->request->data['student_id'] = 3;
//        $this->request->data['school_id'] = 1;
//        $this->request->data['session'] = "2015-2016";
        $this->rq($this->request->data);
        $res = $this->Results->find()
                ->hydrate(false)
                ->where([
                    'Results.school_id' => $this->request->data['school_id'],
                    'Results.classroom_id' => $this->request->data['classroom_id'],
                    'Results.student_id' => $this->request->data['student_id'],
                    'Results.session' => $this->request->data['session'],
                    'Results.resultcategory_id' => $this->request->data['resultcategory_id']
                ])
                ->select(['Results.get_marks','total_mark'])
                ->contain([
                    'Subjects'=>function($q){
                        return $q->select(['id','name']);
                    }
                ]);
        $result = $this->paginate($res);

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
}
