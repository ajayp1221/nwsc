<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExamstablesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExamstablesTable Test Case
 */
class ExamstablesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExamstablesTable
     */
    public $Examstables;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.examstables',
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
        'app.students',
        'app.teachers',
        'app.studentattendances',
        'app.teacherattendances',
        'app.teachersalaries',
        'app.timetables',
        'app.subjects',
        'app.studentleaves',
        'app.teacherleaves',
        'app.events',
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
        $config = TableRegistry::exists('Examstables') ? [] : ['className' => 'App\Model\Table\ExamstablesTable'];
        $this->Examstables = TableRegistry::get('Examstables', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Examstables);

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
