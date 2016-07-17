<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Crons Controller
 *
 * @property \App\Model\Table\HolidaysTable $Holidays
 * @property \App\Model\Table\SchoolsTable $Schools
 * @property \App\Model\Table\StudentattendancesTable $Studentattendances
 * @property \App\Model\Table\NotificationsTable $Notifications
 * @property \App\Model\Table\MobilsmslogsTable $Mobilsmslogs
 * @property \App\Model\Table\SettingsTable $Settings
 * @property \App\Model\Table\SettingsTable $Events
 * @property \App\Model\Table\HomeworksTable $Homeworks
 */
class CronsController extends AppController
{

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
    }
    /**
     * Absent Sms Guardian
     */
    public function absentSms(){
        ini_set('memory_limit', '-1');  
        ini_set('max_execution_time', -1);
        $this->loadModel('Settings');
        $this->loadModel('Studentattendances');
        $this->loadModel('Users');
        $time = date("H:i");
//        $time = "11:00";
        $date = date("d-m-Y");
//        $date = "23-05-2016";
        $methods = new \App\Common\Methods();
        $message = "";
        $settings = $this->Settings->find()->select(['school_id','value'])->where(['type'=>'absent_sms_time','value'=> $time])->toArray();
        foreach($settings as $setting){
            $studentattendances = $this->Studentattendances->find()->select([
                'student_id','id'
            ])->contain([
                'Students' => function ($q){
                    return $q->select(['first_name','last_name','gender', 'father_name','guardian_mobile_1']);
                }
            ])->where([
                'Studentattendances.school_id' => $setting->school_id,
                'Studentattendances.attendance' => 2,
                'Studentattendances.date' => $date
            ])->toArray();
            foreach($studentattendances as $studentattendance){
                $scInfo = $this->Settings->Schools->find()->where([
                    'Schools.id' => $setting->school_id
                ])->select([
                    'id','user_id'
                ])->contain([
                    'Users' => function($q){
                        return $q->select(['id','sms_left']);
                    }
                ])->first();
                
                if($scInfo->user->sms_left){
                    if($studentattendance->student->gender){$gender = "son";}else{$gender = "daughter";}
                    $pName = explode(' ',$studentattendance->student->father_name);
                    $pName = end($pName);
                    $message = "Hello Mr. ".$pName." your $gender ".$studentattendance->student->first_name." is absent today";
                    $res = $methods->smslogs(
                            $setting->school_id,
                            'Studentattendances',
                            $studentattendance->id,
                            $message,'Guardian','0',
                            $studentattendance->student->guardian_mobile_1
                            );
                    $multiplier = $res['multiplier'];
                    $this->Users->updateAll(['sms_sent = sms_sent + ' . $multiplier, "sms_left = sms_left - $multiplier"], ['id' => $scInfo->user->id]);
                }
            }
        }
        exit;
    }
    
    /**
     * Absent App Notification Guardian
     */
    public function absentAppNoty(){
        ini_set('memory_limit', '-1');  
        ini_set('max_execution_time', -1);
        $this->loadModel('Settings');
        $this->loadModel('Studentattendances');
        $time = date("H:i");
//        $time = "11:00";
        $date = date("d-m-Y");
//        $date = "22-05-2016";
        $methods = new \App\Common\Methods();
        $message = "";
        $settings = $this->Settings->find()->select(['school_id','value'])->where(['type'=>'absent_sms_time','value'=> $time])->toArray();
        foreach($settings as $setting){
            $studentattendances = $this->Studentattendances->find()->select([
                'student_id','id'
            ])->contain([
                'Students' => function ($q){
                    return $q->select(['id','first_name','last_name','gender','is_noty','device_token','is_app'])->contain([
                        'Guardians' => function($q){
                            return $q->select(['id','name','gender','is_app','app_type','device_token','is_noti'])->where(['is_app' => 1]);
                        }
                    ])->where(['is_app' => 1]);
                }
            ])->where([
                'Studentattendances.school_id' => $setting->school_id,
                'Studentattendances.attendance' => 2,
                'Studentattendances.date' => $date
            ])->toArray();
            foreach($studentattendances as $studentattendance){
                $stdMsg = "Hey ".$studentattendance->student->first_name." why are you absent today.?"; 
                $methods->appnotylogs(
                    $setting->school_id,
                    'Studentattendances',
                    $studentattendance->id,
                    $stdMsg,
                    'student_id',
                    $studentattendance->student->id,
                    $studentattendance->student->device_token,
                    $this->studentAppApikey,'android',
                    $studentattendance->student->is_noty
                );
                if($studentattendance->student->gender){$gender = "son";}else{$gender = "daughter";}
                foreach($studentattendance->student->guardians as $guardian){
                    if($guardian->gender){$mr = "Mr.";}else{$mr = "Mrs.";}
                    $pName = explode(' ',$guardian->name);
                    $pName = end($pName);
                    $message = "Hello $mr $pName your $gender ".$studentattendance->student->first_name." is absent today";
                    $methods->appnotylogs(
                        $setting->school_id,
                        'Studentattendances',
                        $studentattendance->id,
                        $message,
                        'guardian_id',
                        $guardian->id,
                        $guardian->device_token,
                        $this->studentAppApikey,
                        'android',
                        $guardian->is_noti
                    );
                }
            }
        }
        exit;
    }
    
    
    /**
     * Event Notificatication
     */
    
    public function eventSms(){
        \Cake\Core\Configure::write('debug',TRUE);
        ini_set('memory_limit', '-1');  
        ini_set('max_execution_time', -1);
        $this->loadModel('Events');
        $this->loadModel('Schools');
        $this->loadModel('Users');
        $events = $this->Events->find()->where([
            'is_noty' => 1
        ]);
        $methods = new \App\Common\Methods();
        foreach($events as $event){
            $check = $this->Events->find()->where(['is_noty' => 1,'id' => $event->id])->count();
            if($check){
//                $this->Events->updateAll(['is_noty' => 0],['id' => $event->id]);
                $schoolLists = $this->Schools->find()->where([
                    'Schools.id' => $event->school_id
                ])->contain([
                    'Students' => function ($q){
                        return $q->select([
                            'school_id','first_name','last_name','gender', 'father_name','guardian_mobile_1','guardian_mobile_2'
                        ]);
                    }
                ])->toArray();
                foreach($schoolLists as $schoolList){
                    foreach($schoolList->students as $student){
                        $scInfo = $this->Schools->find()->where(['Schools.id' => $event->school_id])->select(['id','user_id'])->contain([
                                'Users' => function($q){return $q->select(['id','sms_left']);}])->first();
                        if($scInfo->user->sms_left){
                            $pName = explode(' ',$student->father_name);
                            $pName = end($pName);
                            $message = "Hello $pName this is new event $event->name";
                            $res = $methods->smslogs(
                                    $event->school_id,
                                    'Events',
                                    $event->id,
                                    $message,
                                    'Guardian',
                                    '0',
                                    $student->guardian_mobile_1
                                    );
                            $multiplier = $res['multiplier'];
                            $this->Users->updateAll(['sms_sent = sms_sent + ' . $multiplier, "sms_left = sms_left - $multiplier"], ['id' => $scInfo->user->id]);
                        }
                    }
                }
            }
        }exit;
    }
    /**
     * Event Notificatication
     */
    
    public function eventAppNoty(){
        \Cake\Core\Configure::write('debug',TRUE);
        $this->loadModel('Events');
        $this->loadModel('Schools');
        $events = $this->Events->find()->where([
            'is_noty' => 1
        ]);
        $methods = new \App\Common\Methods();
        foreach($events as $event){
            $check = $this->Events->find()->where(['is_noty' => 1,'id' => $event->id])->count();
            if($check){
                $this->Events->updateAll(['is_noty' => 0],['id' => $event->id]);
                $schoolLists = $this->Schools->find()->where([
                    'Schools.id' => $event->school_id
                ])->contain([
                    'Students' => function ($q){
                        return $q->select(['id','school_id','first_name','last_name','gender','is_noty','device_token','is_app'])->contain([
                            'Guardians' => function($q){
                                return $q->select(['id','name','gender','is_app','app_type','device_token','is_noti'])
                                        ->where(['Guardians.is_app' => 1]);
                            }
                        ])->where(['is_app' => 1]);
                    },
                    'Teachers' => function($q){
                        return $q->select(['id','school_id','first_name', 'last_name','device_token'])->where(['is_app' => 1]);
                    }
                ])->toArray();
                foreach($schoolLists as $schoolList){
                    foreach($schoolList->teachers as $teacher){
                        if($teacher->gender){$mr = "Mr.";}else{$mr = "Mrs.";}
                        $pName = explode(' ',$teacher->full_name);
                        $pName = end($pName);
                        $message = "Hello $mr $pName this is new event $event->name";
                        $methods->appnotylogs(
                            $event->school_id,
                            'Events',
                            $event->id,
                            $message,
                            'teacher_id',
                            $teacher->id,
                            $teacher->device_token,
                            $this->teacherAppApikey,
                            'android',
                            $teacher->is_noti
                        );
                    }
                    foreach($schoolList->students as $student){
                        $stdMsg = "Hey ".$student->first_name." this is new event ".$event->name; 
                        $methods->appnotylogs(
                            $event->school_id,
                            'Events',
                            $event->id,
                            $stdMsg,
                            'student_id',
                            $student->id,
                            $student->device_token,
                            $this->studentAppApikey,'android',
                            $student->is_noty
                        );
                        foreach($student->guardians as $guardian){
                            if($guardian->gender){$mr = "Mr.";}else{$mr = "Mrs.";}
                            $pName = explode(' ',$guardian->name);
                            $pName = end($pName);
                            $message = "Hello $mr $pName this is new event $event->name";
                            $methods->appnotylogs(
                                $event->school_id,
                                'Events',
                                $event->id,
                                $message,
                                'guardian_id',
                                $guardian->id,
                                $guardian->device_token,
                                $this->studentAppApikey,
                                'android',
                                $guardian->is_noti
                            );
                        }
                    }
                }
            }
        }exit;
    }
    
    public function homeworkAppNoty(){
        $this->loadModel('Homeworks');
        $methods = new \App\Common\Methods();
        $homeworks = $this->Homeworks->find()->where([
            'Homeworks.is_noty' => 1
        ])->contain([
            'Subjects' => function ($q){
                return $q->select(['name']);
            },
            'Classrooms' => function($q){
                return $q->select(['id'])->contain([
                    'Students' => function($q){
                        return $q->select([
                            'id','classroom_id','is_noty','device_token','is_app','first_name'
                        ])->contain([
                            'Guardians' => function ($q){
                                return $q->select(['id','is_noti','device_token','is_app']);
                            }
                        ]);
                    }
                ]);
            }
        ])->select([
            'id','school_id','subject_id','classroom_id','teacher_id','is_noty'
        ])->toArray();
        foreach($homeworks as $homeworkClassroom){
            $this->Homeworks->updateAll(['is_noty'=> 0], ['id' => $homeworkClassroom->id]);
            foreach($homeworkClassroom->classroom->students as $student){
                if($student->is_app){
                    $stdMsg = "Hey ".$student->first_name." your ".$homeworkClassroom->subject->name." homework"; 
                    $methods->appnotylogs(
                        $homeworkClassroom->school_id,
                        "Homeworks",
                        $homeworkClassroom->id,
                        $stdMsg,
                        'student_id',
                        $student->id,
                        $student->device_token,
                        $this->studentAppApikey,
                        'android',
                        $student->is_noty
                    );
                }
                foreach($student->guardians as $guardian){
                    if($guardian->is_app){
                        if($guardian->gender){$mr = "Mr.";}else{$mr = "Mrs.";}
                        if($student->gender){$gender = "son";}else{$gender = "daughter";}
                        $pName = explode(' ',$guardian->name);
                        $pName = end($pName);
                        $message = "Hello ".$mr. $pName." " .$homeworkClassroom->subject->name. "your $gender ".$student->first_name." Homework";
                        $methods->appnotylogs(
                            $homeworkClassroom->school_id,
                            'Homeworks',
                            $homeworkClassroom->id,
                            $message,
                            'guardian_id',
                            $guardian->id,
                            $guardian->device_token,
                            $this->studentAppApikey,
                            'android',
                            $guardian->is_noti
                        );
                    }
                }
            }
        }
    }

    /**
     * For add studentattandence Holiday
     */
    public function leaveCronHoliday() {
        $date = date("d-m-Y") ;
        $startTimestamp = date("d-m-Y")."00:00:00";
        $endTimestamp = date("d-m-Y H:i:s");
        $startTimestamp = strtotime($startTimestamp);
        $endTimestamp = strtotime($endTimestamp);
        $this->loadModel('Holidays');
        $holidays = $this->Holidays->find()->where(['date' => $date])->toarray();
        foreach($holidays as $holiday){
            $schoolInfo=[
                'session' => $holiday->session,
                'school_id' => $holiday->school_id
            ];
            $school = $this->Holidays->Schools->find()
                    ->select(['id'])
                    ->contain([
                    'Students' => function($q)use($schoolInfo){
                        return $q->select(['id','school_id','classroom_id','first_name','last_name','image','session'])
                                ->where([
                                    'school_id' =>  $schoolInfo['school_id'],
                                    'session' => $schoolInfo['session']
                                ])
                                ->order(['first_name' => 'asc'])
                                ->contain([
                                    'Studentattendances' => function($q1){
                                        return $q1->where(['date' => date('d-m-Y')])
                                                ->order(['id' => 'desc']);
                                    }
                                ]);
                    }])->where([
                        'status' => 1,'id' => $holiday->school_id
                    ])->first();
            foreach($school->students as $students){
                $data = [
                    'school_id' => $holiday->school_id,
                    'student_id' => $students->id,
                    'classroom_id' => $students->classroom_id,
                    'attendance' => 0,
                    'status' => 1,
                    'date' => date("d-m-Y"),
                    'session' => $holiday->session
                ];
                if (@$students->studentattendances[0]) {
                    $data = $this->Schools->Studentattendances->patchEntity($students->studentattendances[0],$data);
                }else{
                    $data = $this->Schools->Studentattendances->newEntity($data);
                }
                $result[] = $this->Schools->Studentattendances->save($data);
            }
        }
        $this->set(compact(['result']));
        $this->set('_serialize','result');
    }
    /**
     * For add studentattandence Sunday
     */
    public function leaveCronSunday(){
        $date = date("d-m-Y");
        $day = date('l', strtotime($date));
        if ($day == "Sunday") {
            $this->loadModel('Schools');
            $schools = $this->Schools->find()->where(['status' => 1])->select([
                'id','session'
            ])->toArray();
            foreach($schools as $school){
                $students = $this->Schools->Students->find()->where([
                    'school_id' => $school->id,
                    'session' => $school->session
                ])->contain([
                    'Studentattendances' => function($q1){
                        return $q1->where(['date' => date('d-m-Y')])
                                ->order(['id' => 'desc']);
                    }
                ])->select([
                    'id','school_id','classroom_id'
                ])->order(['first_name' => 'asc'])->toArray();
                foreach($students as $student){
                    $data = [
                       'school_id' => $student->school_id,
                       'student_id' => $student->id,
                       'classroom_id' => $student->classroom_id,
                       'attendance' => 0,
                       'status' => 1,
                       'date' => date("d-m-Y"),
                       'session' => $school->session
                   ];
                   if (@$student->studentattendances[0]) {
                       $data = $this->Schools->Studentattendances->patchEntity($student->studentattendances[0],$data);
                   }else{
                       $data = $this->Schools->Studentattendances->newEntity($data);
                   }
                   $result[] = $this->Schools->Studentattendances->save($data);
               }
            }
        }else{
            $result['msg'] = "Today is not sunday";
        }
        $this->set(compact(['result']));
        $this->set('_serialize','result');
    }
}
