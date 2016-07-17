<?php
namespace App\Controller\Apiteacher;

use App\Controller\Apiteacher\AppController;

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
    
    public function view(){
//        $this->request->data['school_id'] = 1;
        $this->request->data['session'] = "2015-2016";
        $result = $this->Results->find()
                ->hydrate(false)
                ->where([
                    'school_id' => $this->request->data['school_id'],
                    'session' => $this->request->data['session']
                ])
                ->first();
        if($result){
            $result['error'] = 0;
            $result['msg'] = "sussess";
        }else{
            $result['error'] = 1;
            $result['msg'] = "Something went wrong please try again";
        }
        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }
    
    public function markInSubject(){
        $this->request->allowMethod(['post', 'put']);
//        $this->request->data['resultcategory_id'] = 0;
//        $this->request->data['classroom_id'] = 1;
//        $this->request->data['subject_id'] = 3;
//        $this->request->data['school_id'] = 1;
//        $this->request->data['session'] = "2015-2016";
        
        $res = $this->Results->find()
                ->where([
                    'Results.school_id' => $this->request->data['school_id'],
                    'Results.classroom_id' => $this->request->data['classroom_id'],
                    'Results.subject_id' => $this->request->data['subject_id'],
                    'Results.session' => $this->request->data['session'],
                    'Results.resultcategory_id' => $this->request->data['resultcategory_id']
                ])
                ->select(['Results.id','Results.get_marks','Results.total_mark'])
                ->contain([
                    'Students'=>function($q){
                        return $q->select(['id','first_name','last_name','session','image']);
                    }
                ]);
        $result = $this->paginate($res);

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }

    public function add(){
        $this->request->allowMethod(['post', 'put']);
        $this->request->data['status'] = 1;
        $this->rq($this->request->data);
        $check = $this->Results->find()->where([
            'resultcategory_id' => $this->request->data['resultcategory_id'],
            'school_id' => $this->request->data['school_id'],
            'session' => $this->request->data['session'],
            'classroom_id' => $this->request->data['classroom_id'],
            'student_id' => $this->request->data['student_id'],
            'subject_id' => $this->request->data['subject_id']
        ])->first();
        if($check){
            $this->Results->id = $check->id;
            $res = $this->Results->patchEntity($check,$this->request->data);
        }else{
            $res = $this->Results->newEntity();
            $res = $this->Results->patchEntity($res,$this->request->data);
        }
        
        
        if ($this->Results->save($res)) {
            $result['error'] = 0;
            $result['msg'] = "Saved Successfully ";
        } else {
            $result['error'] = 1;
            $result['msg'] = "Something went wrong please try again";
        }
        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }
    
    public function edit($id = null)
    {
        $res = $this->Results->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $res = $this->Results->patchEntity($res, $this->request->data);
            if ($this->Results->save($res)) {
                $result['error'] = 0;
                $result['msg'] = "Mark updated scucessfully ";
            } else {
                $result['error'] = 1;
                $result['msg'] = "Something went wrong please try again";
            }
        }
        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }
    
    public function addResultByClass(){
        $d = $this->request->data;
        $this->rq($d);
        $d1 = json_decode($d['resultdata'],TRUE);
        $result = [
            'error' => 1,
            'msg' => 'something went wrong please try again',
        ];
        foreach ($d1['studentdata'] as $dSave){
            $checkRecord = $this->Results->find()
                    ->where([
                        'resultcategory_id' => $dSave['resultcategory_id'],
                        'school_id' => $dSave['school_id'],
                        'classroom_id' => $dSave['classroom_id'],
                        'student_id' => $dSave['student_id'],
                        'subject_id' => $dSave['subject_id'],
                        'session' => $dSave['session']
                    ])
                    ->first();
            if($checkRecord){
                $dataSave = $this->Results->patchEntity($checkRecord,$dSave);
            }else{
                $dataSave = $this->Results->newEntity($dSave);
            }
            $saveRes = $this->Results->save($dataSave);
            unset($dataSave);
        }
        if($saveRes){
            $result = [
                'error' => 0,
                'msg' => 'result has been upload successfully',
            ];
        }
        $this->set(compact(['result']));
        $this->set('_serialize',['result']);
        
    }
}
