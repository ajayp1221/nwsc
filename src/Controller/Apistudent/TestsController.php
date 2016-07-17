<?php
namespace App\Controller\Apistudent;

use App\Controller\Apistudent\AppController;
use Cake\Routing\Router;

/**
 * Tests Controller
 */
class TestsController extends AppController
{
    
    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }

    /**
     * Index method
     */
    
    public function index() {
        $path = Router::url('/', true);
        
        $indexInfo['description'] = "Guardians Registration";
        $indexInfo['url'] = $path."apistudent/guardians/add.json";
        $indexInfo['parameters'] = 
        '<b>data[email] - </b>Email<br>
        <b>data[name] - </b> Name<br>
        <b>data[mobile] - </b> Mobile<br>
        <b>data[gender] - </b> Gender<br>
        <b>data[password] - </b> Password<br>
        <b>data[device_token] - </b> Device Token<br>
        <b>data[deviceid] - </b> DeviceId';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Guardians Login";
        $indexInfo['url'] = $path."apistudent/guardians/login.json";
        $indexInfo['parameters'] = 
        '<b>data[email] - </b>Email<br>
        <b>data[app_pwd] - </b> Password<br>
        <b>data[device_token] - </b> Device Token<br>
        <b>data[is_app] - </b> Is App<br>
        <b>data[app_type] - </b> android/ios<br/>
        <b>data[deviceid] - </b> DeviceId';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Select City";
        $indexInfo['url'] = $path."apistudent/guardians/select-city.json";
        $indexInfo['parameters'] = 
        '<b>data[city_name] - </b>City Name';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Select School";
        $indexInfo['url'] = $path."apistudent/guardians/select-school.json";
        $indexInfo['parameters'] = 
        '<b>data[city_id] - </b>City Id';
        $result[] = $indexInfo;
        
        
        $indexInfo['description'] = "Select Classroom";
        $indexInfo['url'] = $path."apistudent/guardians/select-class.json";
        $indexInfo['parameters'] = 
        '<b>data[school_id] - </b>School Id';
        $result[] = $indexInfo;
        
        
        
        $indexInfo['description'] = "Search Student";
        $indexInfo['url'] = $path."apistudent/guardians/search-student.json";
        $indexInfo['parameters'] = 
        '<b>data[classroom_id] - </b>School Id';
        $result[] = $indexInfo;
        
        
        
        $indexInfo['description'] = "Select Child";
        $indexInfo['url'] = $path."apistudent/guardians/select-child.json";
        $indexInfo['parameters'] = 
        '<b>data[student_id] - </b>Student Id<br/>
        <b>data[guardian_id] - </b>Guardian Id ';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Remove Child";
        $indexInfo['url'] = $path."apistudent/guardians/remove-child.json";
        $indexInfo['parameters'] = 
        '<b>data[student_id] - </b>Student Id<br/>
        <b>data[guardian_id] - </b>Guardian Id ';
        $result[] = $indexInfo;
        
        
        $indexInfo['description'] = "Guardians Change Password";
        $indexInfo['url'] = $path."apistudent/guardians/changepwd/(guardians_id).json";
        $indexInfo['parameters'] = 
        '<b>data[old_password] - </b>Old Password<br>
        <b>data[password1] - </b> New Password<br>
        <b>data[password2] - </b> Confirm Password<br>';
        $result[] = $indexInfo;
        
        
        $indexInfo['description'] = "Guardians Forget Password";
        $indexInfo['url'] = $path."apistudent/guardians/forgetpwd.json";
        $indexInfo['parameters'] = 
        '<b>data[email] - </b>Email/Contact-No(for future)<br>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Student Login";
        $indexInfo['url'] = $path."apistudent/students/login.json";
        $indexInfo['parameters'] = 
        '<b>data[email] - </b>Email<br>
        <b>data[password] - </b> Password<br>
        <b>data[is_app] - </b> Is App<br>
        <b>data[device_token] - </b> Device Token<br>
        <b>data[app_type] - </b> android/ios<br/>
        <b>data[deviceid] - </b> DeviceId';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Student Change Password";
        $indexInfo['url'] = $path."apistudent/students/changepwd/(student_id).json";
        $indexInfo['parameters'] = 
        '<b>data[old_password] - </b>Old Password<br>
        <b>data[password1] - </b> New Password<br>
        <b>data[password2] - </b> Confirm Password<br>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Student Forget Password";
        $indexInfo['url'] = $path."apistudent/students/forgetpwd.json";
        $indexInfo['parameters'] = 
        '<b>data[email] - </b>Email/Contact-No(for future)<br>';
        $result[] = $indexInfo;
        
       
        $indexInfo['description'] = "Home Work";
        $indexInfo['url'] = $path."apistudent/homeworks.json?page=(pageCount)";
        $indexInfo['parameters'] = '
            <b>data[school_id] - </b> School Id <br/>
            <b>data[session] - </b> School Current Session<br/>
            <b>data[classroom_id] - </b> ClassroomId<br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "New Session Start Date";
        $indexInfo['url'] = $path."apistudent/studentattendances/startmonth.json";
        $indexInfo['parameters'] = '
            <b>data[school_id] - </b> School ID <br/>
            <b>data[classroom_id] - </b> Classroom ID <br/>
            <b>data[session] - </b> Current Session<br/>';
        $result[] = $indexInfo;

        $indexInfo['description'] = "Student Attendance";
        $indexInfo['url'] = $path."apistudent/studentattendances.json";
        $indexInfo['parameters'] = '
            <b>data[school_id] - </b> School Id <br/>
            <b>data[session] - </b> School Current Session<br/>
            <b>data[student_id] - </b> Student Id<br/>
            <b>data[classroom_id] - </b> ClassroomId<br/>
            <b>data[month] - </b> Month(00)<br/>';
        $result[] = $indexInfo;

        $indexInfo['description'] = "Result-Category";
        $indexInfo['url'] = $path."apistudent/resultcategories.json";
        $indexInfo['parameters'] = '
            <b>data[school_id] - </b> School Id <br/>
            <b>data[session] - </b> School Current Session<br/>';
        $result[] = $indexInfo;

        $indexInfo['description'] = "Student Result";
        $indexInfo['url'] = $path."apistudent/results.json";
        $indexInfo['parameters'] = '
            <b>data[school_id] - </b> School Id <br/>
            <b>data[session] - </b> School Current Session<br/>
            <b>data[student_id] - </b> Student Id<br/>
            <b>data[classroom_id] - </b>ClassroomId<br/>
            data[resultcategory_id] - </b>ResultcategoryID<br/>';
        $result[] = $indexInfo;

        $indexInfo['description'] = "Classroom Timetables";
        $indexInfo['url'] = $path."apistudent/timetables.json";
        $indexInfo['parameters'] = '
            <b>data[school_id] - </b> School Id <br/>
            <b>data[session] - </b> School Current Session<br/>
            <b>data[classroom_id] - </b>ClassroomId<br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Event";
        $indexInfo['url'] = $path."apistudent/events.json?pages=(pageCount)";
        $indexInfo['parameters'] = '
            <b>data[school_id] - </b> School Id <br/>
            <b>data[session] - </b> School Current Session<br/>
            ';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Event View";
        $indexInfo['url'] = $path."apistudent/events/view/(event_id).json";
        $indexInfo['parameters'] = '';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Holiday List";
        $indexInfo['url'] = $path."apistudent/holidays.json";
        $indexInfo['parameters'] = '
            <b>data[school_id] - </b> School Id <br/>
            <b>data[session] - </b> School Current Session<br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Student Apply For Leave";
        $indexInfo['url'] = $path."apistudent/studentleaves/add.json";
        $indexInfo['parameters'] = '
            <b>data[school_id] - </b> School Id <br/>
            <b>data[student_id] - </b> StudentId<br/>
            <b>data[classroom_id] - </b> ClassroomId<br/>
            <b>data[session] - </b> School Current Session<br/>
            <b>data[tilte] - </b> Title<br/>
            <b>data[reason] - </b> Resaon<br/>
            <b>data[from_date] - </b> Date<br/>';
        $result[] = $indexInfo;
        
        
        $indexInfo['description'] = "Student Leave List";
        $indexInfo['url'] = $path."apistudent/studentleaves.json?pages=(pageCount)";
        $indexInfo['parameters'] = '
            <b>data[school_id] - </b> School Id <br/>
            <b>data[student_id] - </b> StudentId<br/>
            <b>data[classroom_id] - </b> ClassroomId<br/>
            <b>data[session] - </b> School Current Session<br/>';
        $result[] = $indexInfo;
        
        
        
        $indexInfo['description'] = "Examstables List";
        $indexInfo['url'] = $path."apistudent/examstables.json";
        $indexInfo['parameters'] = '
            <b>data[school_id] - </b> School Id <br/>
            <b>data[classroom_id] - </b> ClassroomId<br/>
            <b>data[session] - </b> School Current Session<br/>';
        $result[] = $indexInfo;
        
        
        $indexInfo['description'] = "Is  notification Guardian";
        $indexInfo['url'] = $path."apistudent/guardians/is-noti.json";
        $indexInfo['parameters'] = '
            <b>data[id] - </b> Guardian Id <br/>
            <b>data[is_noti]- </b> 1 For send notification / 0 for do not send notification<br/>';
        $result[] = $indexInfo;
        $indexInfo['description'] = "Is  notification Student";
        $indexInfo['url'] = $path."apistudent/students/is-noti.json";
        $indexInfo['parameters'] = '
            <b>data[id] - </b> Student Id <br/>
            <b>data[is_noty]- </b> 1 For send notification / 0 for do not send notification<br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Notification Guardian List";
        $indexInfo['url'] = $path."apistudent/notificationlogs/guardian.json?page=(pageCount)&sort=id&direction=desc";
        $indexInfo['parameters'] = '
            
            <b>data[guardian_id] - </b> Guardian id<br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Notification Student List";
        $indexInfo['url'] = $path."apistudent/notificationlogs/student.json?page=(pageCount)&sort=id&direction=desc";
        $indexInfo['parameters'] = '
            <b>data[student_id] - </b> Student id<br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Notification Is Seen update";
        $indexInfo['url'] = $path."apistudent/notificationlogs/is-seen.json";
        $indexInfo['parameters'] = '
            <b>data[id] - </b> Notificationapplogs id<br/>
            <b>Model Name - </b>Studentattendances, Homeworks, Results, Event, Custom-Messages<br/>
            ';
        $result[] = $indexInfo;
        
        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }
}
