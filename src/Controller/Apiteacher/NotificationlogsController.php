<?php
namespace App\Controller\Apiteacher;

use App\Controller\Apiteacher\AppController;

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
     * Teacher Notification List method
     *
     * @return \Cake\Network\Response|null
     */
    public function teacher()
    {
        $this->request->allowMethod(['post','put']);
        $d = $this->request->data;
//        $d['teacher_id'] = 1;
        $this->rq($d);
        $qry = $this->Notificationlogs->Notificationapplogs->find()
                ->contain([
                    'Notificationlogs' => function($q){
                        return $q->select(['model_name','message']);
                    }
                ])
                ->select(['notificationlog_id','id','is_seen','is_seen_date','created'])
                ->where(['Notificationapplogs.teacher_id' => $d['teacher_id']]);
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
