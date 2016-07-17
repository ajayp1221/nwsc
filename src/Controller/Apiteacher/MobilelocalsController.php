<?php
namespace App\Controller\Apiteacher;

use App\Controller\Apiteacher\AppController;

/**
 * Mobilelocals Controller
 *
 * @property \App\Model\Table\MobilelocalsTable $Mobilelocals
 */
class MobilelocalsController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }

    /**
     * Student Local Data 1 for new changes and 0 for no change method
     *
     * @return \Cake\Network\Response|null
     */
    public function student()
    {
        $d = $this->request->data;
        $this->rq($d);
        $result = $this->Mobilelocals->find()->where([
            'classroom_id' => $d['classroom_id'],
            'model_name' => 'Students',
            'school_id' => $d['school_id'],
            'deviceid' => $d['deviceid']
        ])->select([
            'id','model_name','value'
        ])->first();
        $this->Mobilelocals->updateAll(['value' => 0], ['id' => $result->id]);
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
    
    /**
     * All Model  Local Data 1 for new changes and 0 for no change method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $d = $this->request->data;
        $this->rq($d);
        $result = $this->Mobilelocals->find()->where([
            'model_name' => $d['model_name'],
            'deviceid' => $d['deviceid'],
            'school_id' => $d['school_id']
        ])->select([
            'id','model_name','value'
        ])->first();
        $this->Mobilelocals->updateAll(['value' => 0], ['id' => $result->id]);
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }

}
