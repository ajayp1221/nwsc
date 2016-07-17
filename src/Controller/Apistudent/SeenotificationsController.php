<?php
namespace App\Controller\Apistudent;

use App\Controller\Apistudent\AppController;

/**
 * Seenotifications Controller
 *
 * @property \App\Model\Table\SeenotificationsTable $Seenotifications
 * @property \App\Model\Table\GuardiandeviceidsTable $Guardiandeviceids
 */
class SeenotificationsController extends AppController
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
    public function studentList()
    {
        $this->request->allowMethod(['post','put']);
        $d = $this->request->data;
        $this->rq($d);
        $qry = $this->Seenotifications->find()->contain([
            'Notifications' => function($q){
                return $q->select(['id','modelid','model_name','message']);
            }
        ])->select([
            'id','is_seen','is_seen_date'
        ])->where([
            'Seenotifications.student_id' =>  $d['student_id']
        ])->orderDesc('Seenotifications.id');
        $result = $this->paginate($qry);

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }   
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function guardianList()
    {
        $this->request->allowMethod(['post','put']);
        $d = $this->request->data;
//        $d['deviceid'] = 352795063336837;
//        $d['guardian_id'] = 1;
        $this->rq($d);
        $this->loadModel('Guardiandeviceids');
        $guardiandeviceids = $this->Guardiandeviceids->find()->where([
            'guardian_id' => $d['guardian_id'],
            'deviceid' => $d['deviceid']
        ])->first();
        
        $qry = $this->Seenotifications->find()->contain([
            'Notifications' => function($q){
                return $q->select(['id','modelid','model_name','message']);
            }
        ])->select([
            'id','is_seen','is_seen_date'
        ])->where([
            'Seenotifications.guardian_id' =>  $d['guardian_id'],
            'Seenotifications.guardiandeviceid_id' =>  $guardiandeviceids->id
        ])->orderDesc('Seenotifications.id');
        $result = $this->paginate($qry);

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
    
    public function seen(){
        $this->request->allowMethod(['post','put']);
        $d = $this->request->data;
        $this->rq($d);
        $date = date('d-m-Y');
        $res = $this->Seenotifications->updateAll(['is_seen' => 1,'is_seen_date' => $date],['id' => $d['id']]);
        $result = [
            'error' => 0,
            'message' => 'notification seen successfully'
        ];
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
}
