<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StudentleavesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StudentleavesTable Test Case
 */
class StudentleavesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StudentleavesTable
     */
    public $Studentleaves;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.studentleaves',
        'app.classrooms',
        'app.schools',
        'app.users',
        'app.areas',
        'app.cities',
        'app.states',
        'app.countries',
        'app.settings',
        'app.holidays',
        'app.resultcategories',
        'app.results',
        'app.students',
        'app.teachers',
        'app.studentattendances',
        'app.teacherattendances',
        'app.teachersalaries',
        'app.timetables',
        'app.subjects',
        'app.events',
        'app.classrooms_teachers',
        'app.guardians',
        'app.studentfees',
        'app.schoolfees',
        'app.students_schoolfees',
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
        $config = TableRegistry::exists('Studentleaves') ? [] : ['className' => 'App\Model\Table\StudentleavesTable'];
        $this->Studentleaves = TableRegistry::get('Studentleaves', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Studentleaves);

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
