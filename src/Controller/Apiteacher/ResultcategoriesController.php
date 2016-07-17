<?php
namespace App\Controller\Apiteacher;

use App\Controller\Apiteacher\AppController;

/**
 * Resultcategories Controller
 *
 * @property \App\Model\Table\ResultcategoriesTable $Resultcategories
 */
class ResultcategoriesController extends AppController
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
        $this->request->allowMethod(['post', 'put']);
//        $this->request->data['school_id'] =  1;
//        $this->request->data['session'] = "2015-2016";
        $result = $this->Resultcategories->find()
                ->select(['id','name'])
                ->where([
                    'school_id' => $this->request->data['school_id'],
                    'session' => $this->request->data['session'],
                    'status' => 1
                ])
                ->toArray();
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }

}
