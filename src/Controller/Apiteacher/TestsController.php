<?php
namespace App\Controller\Apiteacher;

use App\Controller\Apiteacher\AppController;
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
        
        $indexInfo['description'] = "Teacher Login";
        $indexInfo['url'] = $path."apiteacher/teachers/login.json";
        $indexInfo['parameters'] = 
        '<b>data[email] - </b>Email<br>
        <b>data[password] - </b> Password<br>
        <b>data[device_token] - </b> Device Token<br>
        <b>data[deviceid] - </b> DeviceId<br>
        <b>data[is_app] - </b> Is App
        <b>data[app_type] - </b> android/ios';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Teacher Update";
        $indexInfo['url'] = $path."apiteacher/teachers/edit/(teacher_id).json";
        $indexInfo['parameters'] = 
        '<b>data[id] - </b>Id<br>
        <b>data[first_name] - </b> First Name<br>
        <b>data[last_name] - </b> Last Name<br>
        <b>data[mobile] - </b> Mobile <br>
        <b>data[dob] - </b> DOB <br>
        <b>data[img] - </b> Image';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Teacher Change Password";
        $indexInfo['url'] = $path."apiteacher/teachers/changepwd/(teacher_id).json";
        $indexInfo['parameters'] = 
        '<b>data[old_password] - </b>Old Password<br>
        <b>data[password1] - </b> New Password<br>
        <b>data[password2] - </b> Confirm Password<br>';
        $result[] = $indexInfo;
        
        
        $indexInfo['description'] = "Teacher Forget Password";
        $indexInfo['url'] = $path."apiteacher/teachers/forgetpwd.json";
        $indexInfo['parameters'] = 
        '<b>data[email] - </b>Email/Contact-No(for future)<br>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Class Section List";
        $indexInfo['url'] = $path."apiteacher/classrooms.json?scid=(schoolid)";
        $indexInfo['parameters'] = '';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Classroom's Student List";
        $indexInfo['url'] = $path."apiteacher/classrooms/studentlist.json";
        $indexInfo['parameters'] = '
            <b>data[school_id] - </b> School ID <br/>
            <b>data[session] - </b> Session <br/>
            <b>data[classroom_id] - </b> Classroom <br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Student Attendance";
        $indexInfo['url'] = $path."apiteacher/studentattendances/add.json";
        $indexInfo['parameters'] = '
            <b>data[alldata] - </b> All Data send in json formate given below filed<br/>
            <b>[school_id] - </b> School ID <br/>
            <b>[student_id] - </b> Student ID <br/>
            <b>[teacher_id] - </b> Teacher ID <br/>
            <b>[classroom_id] - </b> Teacher ID <br/>
            <b>[attendance] - </b> Attendance <br/>
            <b>[session] - </b> Current Session <br/>
            <b>[date] - </b> Current Date (DD-MM-YYYY)';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Student Daily Attendance";
        $indexInfo['url'] = $path."apiteacher/studentattendances/dailyattendace.json?page=(pageCount)";
        $indexInfo['parameters'] = '
            <b>data[classroom_id] - </b> Classroom ID <br/>
            <b>data[date] - </b> Current Date (DD-MM-YYYY)
            <b>data[current_session] - </b> Current Session';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Student Attendance Update";
        $indexInfo['url'] = $path."apiteacher/studentattendances/edit/(studentattendanceid).json";
        $indexInfo['parameters'] = '
            <b>data[id] - </b> Studentattendance ID <br/>
            <b>data[attendance] - </b> Attendance';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "New Session Start Date";
        $indexInfo['url'] = $path."apiteacher/studentattendances/startmonth.json";
        $indexInfo['parameters'] = '
            <b>data[school_id] - </b> School ID <br/>
            <b>data[classroom_id] - </b> Classroom ID <br/>
            <b>data[session] - </b> Current Session<br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Student Add";
        $indexInfo['url'] = $path."apiteacher/students/add.json";
        $indexInfo['parameters'] = '
            <b>data[school_id] - </b> SchoolId <br/>
            <b>data[classroom_id] - </b> ClassroomId <br/>
            <b>data[session] - </b> Session <br/>
            <b>data[first_name] - </b> First Name <br/>
            <b>data[last_name] - </b> Last Name<br/>
            <b>data[dob] - </b> Dob<br/>
            <b>data[img] - </b> Photo<br/>
            <b>data[gender] - </b> 0 (FEMALE)/ 1(MALE)<br/>
            <b>data[address] - </b> Address<br/>
            <b>data[area_id] - </b> AreaId<br/>
            <b>data[city_id] - </b> CityId<br/>
            <b>data[state_id] - </b> StateId<br/>
            <b>data[country_id] - </b> CountryId<br/>
            <b>data[pincode] - </b> CountryId<br/>
            <b>data[father_name] - </b> Father Name<br/>
            <b>data[mother_name] - </b> Mother Name<br/>
            <b>data[guardian_mobile] - </b> Guardian Mobile No<br/>
            <b>data[guardian_email] - </b> Guardian Email<br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Student change status";
        $indexInfo['url'] = $path."apiteacher/students/changestatus.json";
        $indexInfo['parameters'] = '
            <b>data[id] - </b> StudentId <br/>
            <b>data[status] - </b> 0/1 <br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Teacher Timetable";
        $indexInfo['url'] = $path."apiteacher/timetables.json";
        $indexInfo['parameters'] = '
            <b>data[school_id] - </b> School Id <br/>
            <b>data[session] - </b> School Current Session<br/>
            <b>data[teacher_id] - </b> TeacherID<br/>
            <b>data[days] - </b> Day<br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Subject List";
        $indexInfo['url'] = $path."apiteacher/subjects.json";
        $indexInfo['parameters'] = '<b>data[school_id] - </b> School Id <br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Result Category List";
        $indexInfo['url'] = $path."apiteacher/resultcategories.json";
        $indexInfo['parameters'] = '
            <b>data[school_id] - </b> School Id <br/>
            <b>data[session] - </b> Current Session <br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Result Add";
        $indexInfo['url'] = $path."apiteacher/results/add.json";
        $indexInfo['parameters'] = '
            <b>data[resultcategory_id] - </b> Resultcategory Id <br/>
            <b>data[school_id] - </b> School Id <br/>
            <b>data[session] - </b> School Current Session<br/>
            <b>data[classroom_id] - </b> ClassroomId<br/>
            <b>data[student_id] - </b> Student Id<br/>
            <b>data[subject_id] - </b> Subject Id<br/>
            <b>data[total_mark] - </b> Total Mark<br/>
            <b>data[get_marks] - </b> Get Marks<br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Change Mark Result";
        $indexInfo['url'] = $path."apiteacher/results/edit/(result_id).json";
        $indexInfo['parameters'] = '
            <b>data[total_mark] - </b> Total Mark<br/>
            <b>data[get_marks] - </b> Get Marks<br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Mark Subject Wise";
        $indexInfo['url'] = $path."apiteacher/results/mark-in-subject.json?page=(pageCount)";
        $indexInfo['parameters'] = '
            <b>data[resultcategory_id] - </b> Resultcategory Id <br/>
            <b>data[school_id] - </b> School Id <br/>
            <b>data[session] - </b> School Current Session<br/>
            <b>data[classroom_id] - </b> ClassroomId<br/>
            <b>data[subject_id] - </b> Subject Id<br/>';
        $result[] = $indexInfo;
 
        $indexInfo['description'] = "Student List by classroom for add result";
        $indexInfo['url'] = $path."apiteacher/students/student-list-by-class.json";
        $indexInfo['parameters'] = '
            <b>data[resultcategory_id] - </b> Resultcategory Id <br/>
            <b>data[school_id] - </b> School Id <br/>
            <b>data[session] - </b> School Current Session<br/>
            <b>data[classroom_id] - </b> ClassroomId<br/>
            <b>data[subject_id] - </b> Subject Id<br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Add Result By Subject and Classroom all student";
        $indexInfo['url'] = $path."apiteacher/results/add-result-by-class.json";
        $indexInfo['parameters'] = '
            <b>data[resultdata] - </b> Given Below Field In json formate <br/>
            <b>data[resultcategory_id] - </b><br/>
            <b>data[school_id] - </b><br/>
            <b>data[session] - </b><br/>
            <b>data[classroom_id] - </b><br/>
            <b>data[subject_id] - </b><br/>
            <b>data[total_mark] - </b>
            ';
        $result[] = $indexInfo;

        $indexInfo['description'] = "Add Home Work";
        $indexInfo['url'] = $path."apiteacher/homeworks/add.json";
        $indexInfo['parameters'] = '
            <b>data[subject_id] - </b> Subject ID<br/>
            <b>data[school_id] - </b> School Id <br/>
            <b>data[session] - </b> School Current Session<br/>
            <b>data[classroom_id] - </b> ClassroomId<br/>
            <b>data[teacher_id] - </b> Teacher Id<br/>
            <b>data[title] - </b> Title<br/>
            <b>data[result] - </b> Questions<br/>
            <b>data[id] - </b> HomeworkId(if want to add extra quetion)<br/>
            ';
        $result[] = $indexInfo;

        $indexInfo['description'] = "Home Work";
        $indexInfo['url'] = $path."apiteacher/homeworks/view.json?page=(pageCount)";
        $indexInfo['parameters'] = '
            <b>data[subject_id] - </b> Subject ID<br/>
            <b>data[school_id] - </b> School Id <br/>
            <b>data[session] - </b> School Current Session<br/>
            <b>data[classroom_id] - </b> ClassroomId<br/>
            <b>data[teacher_id] - </b> Teacher Id<br/>';
        $result[] = $indexInfo;

        
        $indexInfo['description'] = "HomeWork Question Update";
        $indexInfo['url'] = $path."apiteacher/homeworks/edit/(homeworkId).json";
        $indexInfo['parameters'] = '
            <b>data[id] - </b> HomeWork ID<br/>
            <b>data[title] - </b> Title <br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "HomeWork Delete Post";
        $indexInfo['url'] = $path."apiteacher/homeworks/delete/(id).json";
        $indexInfo['parameters'] = '';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "HomeWork Question Update";
        $indexInfo['url'] = $path."apiteacher/homeworkquestions/edit/(homeworkquestionId).json";
        $indexInfo['parameters'] = '
            <b>data[id] - </b> HomeWork Question ID<br/>
            <b>data[question] - </b> Question <br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "HomeWork Question Delete Post";
        $indexInfo['url'] = $path."apiteacher/homeworkquestions/delete/(id).json";
        $indexInfo['parameters'] = '';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Event Add";
        $indexInfo['url'] = $path."apiteacher/events/add.json";
        $indexInfo['parameters'] = '
            <b>data[school_id] - </b> School Id <br/>
            <b>data[session] - </b> School Current Session<br/>
            <b>data[classroom_id] - </b> ClassroomId<br/>
            <b>data[teacher_id] - </b> Teacher Id<br/>
            <b>data[event_type] - </b> Event Type<br/>
            <b>data[event_name] - </b> Event Name<br/>
            <b>data[start_time] - </b> Start Time<br/>
            <b>data[end_time] - </b> End Time<br/>
            <b>data[description] - </b> Description<br/>
            <b>data[files] - </b> file<br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Event View";
        $indexInfo['url'] = $path."apiteacher/events/view/(event_id).json";
        $indexInfo['parameters'] = '';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Event";
        $indexInfo['url'] = $path."apiteacher/events.json?pages=(pageCount)";
        $indexInfo['parameters'] = '
            <b>data[school_id] - </b> School Id <br/>
            <b>data[session] - </b> School Current Session<br/>
            <b>data[teacher_id] - </b> Teacher Id<br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Holiday List";
        $indexInfo['url'] = $path."apiteacher/holidays.json";
        $indexInfo['parameters'] = '
            <b>data[school_id] - </b> School Id <br/>
            <b>data[session] - </b> School Current Session<br/>';
        $result[] = $indexInfo;
        $indexInfo['description'] = "Seenotifications";
        $indexInfo['url'] = $path."apiteacher/seenotifications.json?pages=(pageCount)";
        $indexInfo['parameters'] = '
            <b>data[teacher_id] - </b> Teacher Id <br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Seenotifications";
        $indexInfo['url'] = $path."apiteacher/seenotifications/seen.json";
        $indexInfo['parameters'] = '
            <b>data[id] - </b> Seenotifications Id <br/>
            <b>Model Name - </b> Studentleaves,Staticnofications<br/>';
        $result[] = $indexInfo;
        $indexInfo['description'] = "Mobilelocals Student's accroding to Classroom ";
        $indexInfo['url'] = $path."apiteacher/mobilelocals/student.json";
        $indexInfo['parameters'] = '
            <b>data[classroom_id] - </b> Classroom Id <br/>
            <b>data[model_name] - </b> Students<br/>
            <b>data[school_id] - </b> SchoolId<br/>
            <b>data[deviceid] - </b> deviceid<br/>';
        $result[] = $indexInfo;
        $indexInfo['description'] = "Mobilelocals According to given Model";
        
        $indexInfo['url'] = $path."apiteacher/mobilelocals.json";
        $indexInfo['parameters'] = '
            <b>data[model_name] - </b> Model Name(Timetables/Students/Classrooms/Resultcatgories/Subjects/Classrooms)<br/>
            <b>data[deviceid] - </b> deviceid<br/>
            <b>data[school_id] - </b> SchoolId<br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Notification Student List";
        $indexInfo['url'] = $path."apiteacher/notificationlogs/teacher.json?page=(pageCount)&sort=id&direction=desc";
        $indexInfo['parameters'] = '
            <b>data[teacher_id] - </b> Teacher id<br/>';
        $result[] = $indexInfo;
        
        $indexInfo['description'] = "Notification Is Seen update";
        $indexInfo['url'] = $path."apiteacher/notificationlogs/is-seen.json";
        $indexInfo['parameters'] = '
            <b>data[id] - </b> Notificationapplogs id<br/>';
        $result[] = $indexInfo;
        

        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }
}
