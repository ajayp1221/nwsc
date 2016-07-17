<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SchoolfeeotherchargesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SchoolfeeotherchargesTable Test Case
 */
class SchoolfeeotherchargesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SchoolfeeotherchargesTable
     */
    public $Schoolfeeothercharges;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.schoolfeeothercharges',
        'app.schoolfees',
        'app.schools',
        'app.users',
        'app.areas',
        'app.cities',
        'app.states',
        'app.countries',
        'app.students',
        'app.classrooms',
        'app.results',
        'app.resultcategories',
        'app.subjects',
        'app.timetables',
        'app.teachers',
        'app.studentattendances',
        'app.seenotifications',
        'app.notifications',
        'app.guardians',
        'app.guardians_students',
        'app.guardiandeviceids',
        'app.teacherattendances',
        'app.teachersalaries',
        'app.studentleaves',
        'app.teacherleaves',
        'app.events',
        'app.classrooms_teachers',
        'app.examstables',
        'app.studentfees',
        'app.students_schoolfees',
        'app.mobilelocals',
        'app.homeworks',
        'app.homeworkquestions',
        'app.settings',
        'app.holidays',
        'app.schoolspayments'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Schoolfeeothercharges') ? [] : ['className' => 'App\Model\Table\SchoolfeeotherchargesTable'];
        $this->Schoolfeeothercharges = TableRegistry::get('Schoolfeeothercharges', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Schoolfeeothercharges);

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
