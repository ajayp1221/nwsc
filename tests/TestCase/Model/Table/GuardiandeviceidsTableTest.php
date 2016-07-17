<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GuardiandeviceidsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GuardiandeviceidsTable Test Case
 */
class GuardiandeviceidsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GuardiandeviceidsTable
     */
    public $Guardiandeviceids;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.guardiandeviceids',
        'app.guardians',
        'app.students',
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
        'app.subjects',
        'app.timetables',
        'app.teachers',
        'app.studentattendances',
        'app.seenotifications',
        'app.notifications',
        'app.teacherattendances',
        'app.teachersalaries',
        'app.studentleaves',
        'app.teacherleaves',
        'app.events',
        'app.classrooms_teachers',
        'app.examstables',
        'app.schoolfees',
        'app.studentfees',
        'app.students_schoolfees',
        'app.mobilelocals',
        'app.homeworks',
        'app.homeworkquestions',
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
        $config = TableRegistry::exists('Guardiandeviceids') ? [] : ['className' => 'App\Model\Table\GuardiandeviceidsTable'];
        $this->Guardiandeviceids = TableRegistry::get('Guardiandeviceids', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Guardiandeviceids);

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
