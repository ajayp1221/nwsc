<?php
namespace App\Controller\Apistudent;

use App\Controller\Apistudent\AppController;

/**
 * Studentleaves Controller
 *
 * @property \App\Model\Table\StudentleavesTable $Studentleaves
 */
class StudentleavesController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->request->allowMethod(['post','put']);
        $d = $this->request->data;
        $this->rq($d);
        $q = $this->Studentleaves->find()->where([
            'student_id' => $d['student_id'],'session' => $d['session'],'classroom_id' => $d['classroom_id'],'school_id' => $d['school_id']
        ]);
        $results = $this->paginate($q);
        $this->set(compact('results'));
        $this->set('_serialize', ['results']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post','put']);
        $d = $this->request->data;
        $this->rq($d);
        $studentleave = $this->Studentleaves->newEntity();
        $this->request->data['status'] = 1;
        $studentleave = $this->Studentleaves->patchEntity($studentleave, $d);
        if ($this->Studentleaves->save($studentleave)) {
            $result = [
                'error' => 0,
                'msg' => 'Leave application has been send successfully'
            ];
        } else {
            $result = [
                'error' => 1,
                'msg' => 'Something went wrong please try again'
            ];
        }
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
}
