<?php
namespace App\Controller\Apiteacher;

use App\Controller\Apiteacher\AppController;

/**
 * Studentattendances Controller
 *
 * @property \App\Model\Table\StudentattendancesTable $Studentattendances
 */
class StudentattendancesController extends AppController
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
        $this->paginate = [
            'contain' => ['Schools', 'Students', 'Teachers']
        ];
        $this->set('studentattendances', $this->paginate($this->Studentattendances));
        $this->set('_serialize', ['studentattendances']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        \Cake\Core\Configure::write('debug',FALSE);
        $this->rq($this->request->data);
        $methods = new \App\Common\Methods();
        $encode= json_decode($this->request->data['alldata'],TRUE);
        $studentattendances = $this->Studentattendances->newEntities($encode['student']);
        foreach($studentattendances as $studentattendance){
            $studentattendance['status'] = 1;
            $studentattendance['deleted'] = 0;
            $res = $this->Studentattendances->save($studentattendance);
            if($res){
                $message = "";
                if($res->attendance==2){
                    $gurdian = $this->Studentattendances->Students->find()->select([
                            'first_name','last_name','gender', 'father_name','guardian_mobile_1'
                        ])->where(['Students.id' => $res->student_id])->first();
                        if($gurdian->gender){$gender = "son";}else{$gender = "daughter";}
                        $pName = explode(' ',$gurdian->father_name);
                        $pName = end($pName);
                        $message = "Hello Mr. ".$pName." your $gender ".$gurdian->first_name." is absent today";
                        $response  = $methods->plivoSms("+91".$gurdian->guardian_mobile_1,$message);
                }
            }
        }
        if($res){
            $result['error'] = "0";
            $result['msg'] = "Attendance sumbitted successfully";
        }else{
            $result['error'] = "1";
            $result['msg'] = "something went wrong please try again";
        }
        $this->set('result', $result);
        $this->set('_serialize', ['result']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Studentattendance id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $studentattendance = $this->Studentattendances->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $studentattendance = $this->Studentattendances->patchEntity($studentattendance, $this->request->data);
            $res = $this->Studentattendances->save($studentattendance);
            if($res){
                $result['error'] = "0";
                $result['msg'] = "Attendance sumbitted successfully";
            }else{
                $result['error'] = "1";
                $result['msg'] = "something went wrong please try again";
            }
            $this->set('result', $result);
            $this->set('_serialize', ['result']);
        }
    }
    
    public function dailyattendace(){
        \Cake\Core\Configure::write('debug',FALSE);
        $d = $this->request->data;
        $this->rq($this->request->data);
        $this->request->allowMethod(['post','put']);
        ini_set('memory_limit', '-1');  
        ini_set('max_execution_time', -1);

        $result = $this->Studentattendances->find()
                ->contain([
                    'Students' => function($q){return $q->select(['id','first_name','last_name','studentid','image']);}
                ])
                ->where([
                    'Studentattendances.school_id' => $d['school_id'],
                    'Studentattendances.session' => $d['current_session'],
                    'Studentattendances.classroom_id' => $d['classroom_id'],
                    'Studentattendances.date' => $d['date']
                ])
                ->select(['id','attendance','session','date']);
        $this->set('result', $this->paginate($result));
        $this->set('_serialize', ['result']);
    }
    
    public function startmonth(){
        if($this->request->is('post')){
            $result = $this->Studentattendances->find()
                ->select('date')
                ->where([
                    'school_id' => $this->request->data['school_id'],
                    'classroom_id' => $this->request->data['classroom_id'],
                    'session' => $this->request->data['session']
                ])
                ->first();
        }
        
        $this->set('result', $result);
        $this->set('_serialize', ['result']);
    }
}
