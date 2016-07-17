<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NotificationlogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NotificationlogsTable Test Case
 */
class NotificationlogsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NotificationlogsTable
     */
    public $Notificationlogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.notificationlogs',
        'app.notificationapplogs',
        'app.guardians',
        'app.students',
        'app.schools',
        'app.users',
        'app.areas',
        'app.cities',
        'app.states',
        'app.countries',
        'app.teachers',
        'app.studentattendances',
        'app.classrooms',
        'app.results',
        'app.resultcategories',
        'app.subjects',
        'app.timetables',
        'app.examstables',
        'app.schoolfees',
        'app.schoolfeeothercharges',
        'app.studentfees',
        'app.students_schoolfees',
        'app.events',
        'app.mobilelocals',
        'app.homeworks',
        'app.homeworkquestions',
        'app.classrooms_teachers',
        'app.seenotifications',
        'app.notifications',
        'app.guardiandeviceids',
        'app.teacherattendances',
        'app.teachersalaries',
        'app.studentleaves',
        'app.teacherleaves',
        'app.settings',
        'app.holidays',
        'app.schoolspayments',
        'app.guardians_students'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Notificationlogs') ? [] : ['className' => 'App\Model\Table\NotificationlogsTable'];
        $this->Notificationlogs = TableRegistry::get('Notificationlogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Notificationlogs);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
