<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SchoolsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SchoolsTable Test Case
 */
class SchoolsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.schools',
        'app.users',
        'app.areas',
        'app.cities',
        'app.states',
        'app.countries',
        'app.classrooms',
        'app.holidays',
        'app.resultcategories',
        'app.results',
        'app.schoolfees',
        'app.studentattendances',
        'app.studentfees',
        'app.students',
        'app.students_schoolfees',
        'app.teacherattendances',
        'app.teachers',
        'app.teachersalaries',
        'app.timetables',
        'app.classrooms_teachers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Schools') ? [] : ['className' => 'App\Model\Table\SchoolsTable'];
        $this->Schools = TableRegistry::get('Schools', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Schools);

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
