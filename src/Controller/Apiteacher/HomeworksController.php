<?php
namespace App\Controller\Apiteacher;

use App\Controller\Apiteacher\AppController;

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
        $this->paginate = [
            'contain' => ['Schools', 'Subjects', 'Classrooms', 'Teachers']
        ];
        $this->set('homeworks', $this->paginate($this->Homeworks));
        $this->set('_serialize', ['homeworks']);
    }

    /**
     * View method
     *
     * @param string|null $id Homework id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view()
    {
        ob_start();
        print_r($this->request->data);
        $c = ob_get_clean();
        $fc = fopen('rq.txt', 'w');
        fwrite($fc, $c);
        fclose($fc);
//        $this->request->data['subject_id']=3;
//        $this->request->data['school_id']=1;
//        $this->request->data['session']="2015-2016";
//        $this->request->data['teacher_id']=1;
//        $this->request->data['classroom_id']=1;
        $res = $this->Homeworks->find()->where([
                    'Homeworks.subject_id' => $this->request->data['subject_id'],
                    'Homeworks.school_id' => $this->request->data['school_id'],
                    'Homeworks.session' => $this->request->data['session'],
                    'Homeworks.teacher_id' => $this->request->data['teacher_id'],
                    'Homeworks.classroom_id' => $this->request->data['classroom_id']
                ])
                ->contain([
                    'Homeworkquestions'=>function($q){return $q->select(['id','homework_id','question']);}
                ])
                ->select(['Homeworks.id','Homeworks.title','Homeworks.created']);
        $result = $this->paginate($res);
        $this->set('result', $result);
        $this->set('_serialize', ['result']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $homework = $this->Homeworks->newEntity();
//        if ($this->request->is('post')) {
//            $this->request->data['title'] ='11';
//            $this->request->data['session'] ='2015-2016';
//            $this->request->data['description'] ="dsagfsadg";
            $this->request->data['status'] =1;
            $this->rq($this->request->data);
//            $this->request->data['subject_id']="3";
//            $this->request->data['school_id']=1;
//            $this->request->data['teacher_id']=1;
//            $this->request->data['classroom_id']=1;
//            $this->request->data['session']='2015-2016';
//            $this->request->data['title']=1111;
//            $this->request->data['result']= '{"result":[{"question":"if the reader to easily access both are"},{"question":"the information is strictly confidential and privileged"}]}';
            $quest =  json_decode($this->request->data['result'],true);
            $this->request->data['homeworkquestions'] = $quest['result'];
            
            $homework = $this->Homeworks->patchEntity($homework, $this->request->data);
//            debug($homework);exit;
            if ($this->Homeworks->save($homework)) {
                $result['error'] = 0;
                $result['msg'] = "sussess";
            } else {
                $result['error'] = 1;
                $result['msg'] = "Something went wrong please try again";
            }
//        }
        $this->set('result', $result);
        $this->set('_serialize', ['result']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Homework id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $homework = $this->Homeworks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $homework = $this->Homeworks->patchEntity($homework, $this->request->data);
            if ($this->Homeworks->save($homework)) {
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
     * @param string|null $id Homework id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $homework = $this->Homeworks->get($id);
        if ($this->Homeworks->delete($homework)) {
            $result['error']=0;
            $result['msg'] = "remove successfully";
        } else {
            $result['error']=1;
            $result['msg'] = "sorry something went wrong please try again";
        }
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
}
