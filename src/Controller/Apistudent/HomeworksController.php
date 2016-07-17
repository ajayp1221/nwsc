<?php
namespace App\Controller\Apistudent;

use App\Controller\Apistudent\AppController;

/**
 * Homeworks Controller
 *
 * @property \App\Model\Table\HomeworksTable $Homeworks
 */
class HomeworksController extends AppController
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
//        $this->request->data['school_id']=1;
//        $this->request->data['session']="2015-2016";
//        $this->request->data['classroom_id']=1;
        $res = $this->Homeworks->find()->where([
                    'Homeworks.school_id' => $this->request->data['school_id'],
                    'Homeworks.session' => $this->request->data['session'],
                    'Homeworks.classroom_id' => $this->request->data['classroom_id']
                ])
                ->contain([
                    'Homeworkquestions'=>function($q){return $q->select(['id','homework_id','question']);},
                    'Subjects' => function($q){return $q->select(['id','name']);},
                    'Teachers' => function($q){return $q->select(['id','first_name','last_name','image']);}
                ])
                ->select(['Homeworks.id','Homeworks.title','Homeworks.created'])
                ->order(['Subjects.id' => 'desc'])
                ;
        $result = $this->paginate($res);
        $this->set('result', $result);
        $this->set('_serialize', ['result']);
    }
}
