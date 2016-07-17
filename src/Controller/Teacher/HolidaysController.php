<?php

namespace App\Controller\Teacher;

use App\Controller\Teacher\AppController;

/**
 * Holidays Controller
 *
 * @property \App\Model\Table\HolidaysTable $Holidays
 * @property \App\Model\Table\TeachersTable $Teachers
 * @property \App\Model\Table\SchoolsTable $Schools
 */
class HolidaysController extends AppController {

    public $paginate = [
        'limit' => 20,
        'order' => [
            'Holidays.id' => 'asc'
        ]
    ];

    /**
     * School Holliday List
     *
     * @return void
     */
    public function index() {
        $results = $this->Holidays->find()
                ->where([
                    'school_id' => $this->Auth->user('school_id'),
                    'session' => $this->Auth->user('session')
                ])->toArray();
        $this->set('holidays', $results);
        $this->set('_serialize', ['holidays']);
    }
}
