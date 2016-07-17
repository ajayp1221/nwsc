<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NotificationapplogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NotificationapplogsTable Test Case
 */
class NotificationapplogsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NotificationapplogsTable
     */
    public $Notificationapplogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.notificationapplogs',
        'app.messagelogs',
        'app.messagesmslogs',
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
        $config = TableRegistry::exists('Notificationapplogs') ? [] : ['className' => 'App\Model\Table\NotificationapplogsTable'];
        $this->Notificationapplogs = TableRegistry::get('Notificationapplogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Notificationapplogs);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
