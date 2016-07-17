<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EventsTable Test Case
 */
class EventsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.events',
        'app.schools',
        'app.users',
        'app.areas',
        'app.cities',
        'app.states',
        'app.countries',
        'app.classrooms',
        'app.results',
        'app.resultcategories',
        'app.students',
        'app.teachers',
        'app.studentattendances',
        'app.teacherattendances',
        'app.teachersalaries',
        'app.timetables',
        'app.subjects',
        'app.classrooms_teachers',
        'app.guardians',
        'app.studentfees',
        'app.schoolfees',
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
        $config = TableRegistry::exists('Events') ? [] : ['className' => 'App\Model\Table\EventsTable'];
        $this->Events = TableRegistry::get('Events', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Events);

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
