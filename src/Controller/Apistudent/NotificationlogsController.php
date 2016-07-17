<?php
namespace App\Controller\Apistudent;

use App\Controller\Apistudent\AppController;

/**
 * Notificationlogs Controller
 *
 * @property \App\Model\Table\NotificationlogsTable $Notificationlogs
 */
class NotificationlogsController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }

    /**
     * Guardian Notification List method
     *
     * @return \Cake\Network\Response|null
     */
    public function guardian()
    {
        $this->request->allowMethod(['post','put']);
        $d = $this->request->data;
        $this->rq($d);
        $qry = $this->Notificationlogs->Notificationapplogs->find()
                ->contain([
                    'Notificationlogs' => function($q){
                        return $q->select(['model_name','message']);
                    }
                ])
                ->select(['notificationlog_id','id','is_seen','is_seen_date','created'])
                ->where(['Notificationapplogs.guardian_id' => $d['guardian_id']]);
        $result = $this->paginate($qry);
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
    /**
     * Student Notification List method
     *
     * @return \Cake\Network\Response|null
     */
    public function student()
    {
        $this->request->allowMethod(['post','put']);
        $d = $this->request->data;
        $this->rq($d);
        $qry = $this->Notificationlogs->Notificationapplogs->find()
                ->contain([
                    'Notificationlogs' => function($q){
                        return $q->select(['model_name','message']);
                    }
                ])
                ->select(['notificationlog_id','id','is_seen','is_seen_date','created'])
                ->where(['Notificationapplogs.student_id' => $d['student_id']]);
        $result = $this->paginate($qry);
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
    
    /**
     * Method for is seen notification
     */
    
    public function isSeen(){
        $this->request->allowMethod(['post','put']);
        $d = $this->request->data;
        $this->rq($d);
        $date = date('d-m-Y H:i');
        $this->Notificationlogs->Notificationapplogs->updateAll(['is_seen' => 1,'is_seen_date' => $date],['id' => $d['id']]);
        $result = [
            'error' => 0,
            'message' => 'notification seen successfully'
        ];
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
}
