<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GuardiansTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GuardiansTable Test Case
 */
class GuardiansTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GuardiansTable
     */
    public $Guardians;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.guardians',
        'app.guardiandeviceids',
        'app.students',
        'app.schools',
        'app.users',
        'app.areas',
        'app.cities',
        'app.states',
        'app.countries',
        'app.teachers',
        'app.studentattendances',
        'app.classrooms',
        'app.results',
        'app.resultcategories',
        'app.subjects',
        'app.timetables',
        'app.examstables',
        'app.schoolfees',
        'app.studentfees',
        'app.students_schoolfees',
        'app.events',
        'app.mobilelocals',
        'app.homeworks',
        'app.homeworkquestions',
        'app.classrooms_teachers',
        'app.seenotifications',
        'app.notifications',
        'app.teacherattendances',
        'app.teachersalaries',
        'app.studentleaves',
        'app.teacherleaves',
        'app.settings',
        'app.holidays',
        'app.schoolspayments',
        'app.guardians_students'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Guardians') ? [] : ['className' => 'App\Model\Table\GuardiansTable'];
        $this->Guardians = TableRegistry::get('Guardians', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Guardians);

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
