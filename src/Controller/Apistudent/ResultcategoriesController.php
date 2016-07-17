<?php
namespace App\Controller\Apistudent;

use App\Controller\Apistudent\AppController;

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
