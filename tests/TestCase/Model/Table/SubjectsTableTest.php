<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubjectsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubjectsTable Test Case
 */
class SubjectsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.subjects',
        'app.results',
        'app.resultcategories',
        'app.schools',
        'app.users',
        'app.areas',
        'app.cities',
        'app.states',
        'app.countries',
        'app.classrooms',
        'app.schoolfees',
        'app.studentfees',
        'app.students',
        'app.teachers',
        'app.studentattendances',
        'app.teacherattendances',
        'app.teachersalaries',
        'app.timetables',
        'app.classrooms_teachers',
        'app.guardians',
        'app.students_schoolfees',
        'app.holidays'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Subjects') ? [] : ['className' => 'App\Model\Table\SubjectsTable'];
        $this->Subjects = TableRegistry::get('Subjects', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Subjects);

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
