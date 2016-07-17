<?php
namespace App\Controller\Teacher;

use App\Controller\Teacher\AppController;
use Cake\Collection\Collection;

/**
 * Classrooms Controller
 *
 * @property \App\Model\Table\ClassroomsTable $Classrooms
 * @property \App\Model\Table\SettingsTable $Settings
 * @property \App\Model\Table\UsersTable $Users
 */
class ClassroomsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Schools']
        ];
        $query = $this->Classrooms->find()->where([
                'Classrooms.school_id' => $this->Auth->user('school_id'),
                'Classrooms.status' => 1,
                'Classrooms.deleted' => 0
            ]);
        $this->set('classrooms', $this->paginate($query));
        $this->set('_serialize', ['classrooms']);
    }
    
    /**
     * Index method
     *
     * @return void
     */
    public function fee($slug=null)
    {
        $this->paginate = [
            'contain' => ['Schools']
        ];
        $query = $this->Classrooms->find()->where([
                'Classrooms.school_id' => $this->Auth->user('school_id'),
                'Classrooms.status' => 1,
                'Classrooms.deleted' => 0
            ]);
//        $classrooms = $this->paginate($query);
        $classrooms = $query->toArray();
        $students = $this->Classrooms->find()->where(['Classrooms.slug' => $slug])->contain([
            'Students' => function($q){
                return $q->select([
                    'id','classroom_id','studentid','session','first_name','last_name','slug','father_name',
                    'mother_name','guardian_mobile_1','image'
                ])->where([
                    'status' => 1,
                    'deleted' => 0,
                    'session' => $this->Auth->user('session')
                ]);
            }
        ])->first();
        
        $this->set(compact('classrooms', 'students'));
        $this->set('_serialize', ['classrooms','students']);
    }


    public function timetablelist($slug = null){
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
        $classroom = $this->Classrooms->find()
                ->contain([
                    'Timetables' => function($q){return $q->order(['Timetables.id' => 'asc']);} ,
                    'Timetables.Subjects' =>  function($qry){
                        return $qry->select([
                            'name', 'slug'
                        ])->where(['Subjects.status' => 1,'Subjects.deleted' => 0]);
                    },
                    'Timetables.Teachers' =>  function($qry){
                        return $qry->select([
                            'first_name', 'last_name', 'slug'
                        ])->where([
                            'Teachers.school_id' => $this->Auth->user('school_id'),
                            'Teachers.status' => 1,
                            'Teachers.deleted' => 0
                        ]);
                    }
                ])
                ->where([
                    'Classrooms.slug' => $slug,
                    'Classrooms.status' => 1,
                    'Classrooms.deleted' => 0
                ])
                ->first();

        $collection = new Collection($classroom->timetables);
        $tmTables = $collection->groupBy('days');
        $timetables = $tmTables->toArray();
        unset($classroom->timetables);
        $this->set(compact('classroom','timetables','settings'));
        $this->set('_serialize', ['classroom']);
    }
    
    public function attendance($slug){
        \Cake\Core\Configure::write('debug',TRUE);
        $this->loadModel('Users');
        if($this->request->is(['post','put'])){
            $d = $this->request->data;
            foreach($d['studentattendance'] as $newData){
                if(@$newData['id']){
                    $dataExit = $this->Classrooms->Studentattendances->get($newData['id']);
                    $dataSave = $this->Classrooms->Studentattendances->patchEntity($dataExit,$newData);
                }else{
                    $dataSave = $this->Classrooms->Studentattendances->newEntity($newData);
                }
                $res = $this->Classrooms->Studentattendances->save($dataSave);
            }
        }
        $classrooms = $this->Classrooms->find()
                ->select([
                    'id','name','section'
                ])
                ->where([
                    'slug' => $slug
                ])
                ->contain([
                    'Students' => function($q){
                        return $q->select(['id','classroom_id','first_name','last_name','image','session'])
                                ->where([
                                    'school_id'=>$this->Auth->user('school_id'),
                                    'session' => $this->Auth->user('session')
                                ])
                                ->order(['first_name' => 'asc'])
                                ->contain([
                                    'Studentattendances' => function($q1){
                                        return $q1->select(['id','student_id','date','attendance'])
                                                ->where(['date' => date('d-m-Y')])
                                                ->order(['id' => 'desc']);
                                    }
                                ]);
                    }
                ])->first();
        $this->set(compact('classrooms'));
        $this->set('_serialize', 'classrooms');
        
    }
}
