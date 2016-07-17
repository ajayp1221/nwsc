<?php
namespace App\Controller\Apiteacher;

use App\Controller\Apiteacher\AppController;

/**
 * Subjects Controller
 *
 * @property \App\Model\Table\SubjectsTable $Subjects
 */
class SubjectsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }
    public function index()
    {
        $this->request->allowMethod(['post', 'put']);
        $result =  $this->Subjects->find()->select(['id','name'])->where(['school_id' => $this->request->data['school_id'],'status' => 1])->toArray();
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }

}
