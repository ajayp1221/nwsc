<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HolidaysTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HolidaysTable Test Case
 */
class HolidaysTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.holidays',
        'app.schools',
        'app.users',
        'app.areas',
        'app.cities',
        'app.states',
        'app.countries',
        'app.classrooms',
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
        $config = TableRegistry::exists('Holidays') ? [] : ['className' => 'App\Model\Table\HolidaysTable'];
        $this->Holidays = TableRegistry::get('Holidays', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Holidays);

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
