<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClassroomsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClassroomsTable Test Case
 */
class ClassroomsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.classrooms',
        'app.schools',
        'app.users',
        'app.areas',
        'app.cities',
        'app.states',
        'app.countries',
        'app.holidays',
        'app.resultcategories',
        'app.results',
        'app.schoolfees',
        'app.studentattendances',
        'app.studentfees',
        'app.students',
        'app.teachers',
        'app.teacherattendances',
        'app.teachersalaries',
        'app.timetables',
        'app.classrooms_teachers',
        'app.guardians',
        'app.students_schoolfees'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Classrooms') ? [] : ['className' => 'App\Model\Table\ClassroomsTable'];
        $this->Classrooms = TableRegistry::get('Classrooms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Classrooms);

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
