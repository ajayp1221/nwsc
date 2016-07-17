<?php
namespace App\Controller\Apiteacher;

use App\Controller\Apiteacher\AppController;

/**
 * Seenotifications Controller
 *
 * @property \App\Model\Table\SeenotificationsTable $Seenotifications
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
    public function index()
    {
        $this->request->allowMethod(['post','put']);
        $d = $this->request->data;
        $this->rq($d);
        \Cake\Core\Configure::write('debug',false);
        $qry = $this->Seenotifications->find()->contain([
            'Notifications' => function($q){
                return $q->select(['id','modelid','model_name','message']);
            }
        ])->select([
            'id','is_seen','is_seen_date'
        ])->where([
            'Seenotifications.teacher_id' =>  $d['teacher_id']
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
        $this->Seenotifications->updateAll(['is_seen' => 1,'is_seen_date' => $date],['id' => $d['id']]);
        $result = [
            'error' => 0,
            'message' => 'notification seen successfully'
        ];
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
}
