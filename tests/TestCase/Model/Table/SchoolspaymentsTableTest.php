<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SchoolspaymentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SchoolspaymentsTable Test Case
 */
class SchoolspaymentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SchoolspaymentsTable
     */
    public $Schoolspayments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.schoolspayments',
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
        'app.guardiandeviceids',
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
        'app.settings',
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
        $config = TableRegistry::exists('Schoolspayments') ? [] : ['className' => 'App\Model\Table\SchoolspaymentsTable'];
        $this->Schoolspayments = TableRegistry::get('Schoolspayments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Schoolspayments);

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
