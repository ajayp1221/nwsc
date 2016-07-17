<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TeacherleavesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TeacherleavesTable Test Case
 */
class TeacherleavesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TeacherleavesTable
     */
    public $Teacherleaves;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.teacherleaves',
        'app.teachers',
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
        'app.guardians',
        'app.studentattendances',
        'app.studentfees',
        'app.schoolfees',
        'app.students_schoolfees',
        'app.subjects',
        'app.timetables',
        'app.events',
        'app.classrooms_teachers',
        'app.holidays',
        'app.teacherattendances',
        'app.teachersalaries',
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
        $config = TableRegistry::exists('Teacherleaves') ? [] : ['className' => 'App\Model\Table\TeacherleavesTable'];
        $this->Teacherleaves = TableRegistry::get('Teacherleaves', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Teacherleaves);

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
