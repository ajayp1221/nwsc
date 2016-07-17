<?php

namespace App\Controller\Apistudent;

use App\Controller\Apistudent\AppController;

/**
 * Holidays Controller
 *
 * @property \App\Model\Table\HolidaysTable $Holidays
 * @property \App\Model\Table\TeachersTable $Teachers
 * @property \App\Model\Table\SchoolsTable $Schools
 */
class HolidaysController extends AppController {

    
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }

    /**
     * School Holliday List
     *
     * @return void
     */
    public function index() {
        $this->request->allowMethod(['post','put']);
        $d = $this->request->data;
        $this->rq($d);
        $results = $this->Holidays->find()
                ->where([
                    'school_id' => $d['school_id'],
                    'session' => $d['session']
                ])->toArray();
        $this->set(compact('results'));
        $this->set('_serialize', ['results']);
    }
}
