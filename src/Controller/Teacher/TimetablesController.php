<?php
namespace App\Controller\Teacher;

use App\Controller\Teacher\AppController;
use Cake\Collection\Collection;

/**
 * Timetables Controller
 *
 * @property \App\Model\Table\TimetablesTable $Timetables
 * @property \App\Model\Table\SettingsTable $Settings
 */
class TimetablesController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }

    public function index(){
        $this->loadModel('Settings');
        $settings = $this->Settings->find()->where([
            'status' => 1,
            'deleted' => 0,
            'school_id' => $this->Auth->user('school_id')
        ])
        ->select(['type','value'])
        ->hydrate(false)
        ->order(['type' => 'asc'])
        ->toArray();
        $results = $this->Timetables->find()
                ->contain([
                    'Subjects' => function($q){return $q->select(['name']);},
                    'Classrooms' => function($q){return $q->select(['id','name','section']);}
                ])
                ->where([
                    'Timetables.school_id' => $this->Auth->user('school_id'),
                    'Timetables.session' => $this->Auth->user('session'),
                    'Timetables.teacher_id' => $this->Auth->user('id'),
                    'Timetables.status' => 1
                ])
                ->select(['period_no','period_time','days'])
                ->order(['period_time' => "asc"])
                ->toArray();
        $collection = new Collection($results);
        $tmTables = $collection->groupBy('days');
        $timetables = $tmTables->toArray();
        $this->set(compact('timetables','settings'));
        $this->set('_serialize', ['timetables','settings']);
    }
}
