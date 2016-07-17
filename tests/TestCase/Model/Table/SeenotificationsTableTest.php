<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SeenotificationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SeenotificationsTable Test Case
 */
class SeenotificationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SeenotificationsTable
     */
    public $Seenotifications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.seenotifications',
        'app.notifications',
        'app.guardians',
        'app.students',
        'app.schools',
        'app.users',
        'app.areas',
        'app.cities',
        'app.states',
        'app.countries',
        'app.settings',
        'app.classrooms',
        'app.results',
        'app.resultcategories',
        'app.subjects',
        'app.timetables',
        'app.teachers',
        'app.studentattendances',
        'app.teacherattendances',
        'app.teachersalaries',
        'app.studentleaves',
        'app.teacherleaves',
        'app.events',
        'app.classrooms_teachers',
        'app.examstables',
        'app.schoolfees',
        'app.studentfees',
        'app.students_schoolfees',
        'app.holidays',
        'app.homeworks',
        'app.homeworkquestions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Seenotifications') ? [] : ['className' => 'App\Model\Table\SeenotificationsTable'];
        $this->Seenotifications = TableRegistry::get('Seenotifications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Seenotifications);

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
