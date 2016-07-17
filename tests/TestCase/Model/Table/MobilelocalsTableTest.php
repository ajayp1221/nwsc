<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MobilelocalsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MobilelocalsTable Test Case
 */
class MobilelocalsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MobilelocalsTable
     */
    public $Mobilelocals;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.mobilelocals',
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
        'app.seenotifications',
        'app.notifications',
        'app.guardians',
        'app.teacherattendances',
        'app.teachersalaries',
        'app.timetables',
        'app.subjects',
        'app.examstables',
        'app.studentleaves',
        'app.teacherleaves',
        'app.events',
        'app.classrooms_teachers',
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
        $config = TableRegistry::exists('Mobilelocals') ? [] : ['className' => 'App\Model\Table\MobilelocalsTable'];
        $this->Mobilelocals = TableRegistry::get('Mobilelocals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Mobilelocals);

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
