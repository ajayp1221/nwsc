<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\Admin\CitiesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\Admin\CitiesController Test Case
 */
class CitiesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cities',
        'app.states',
        'app.areas',
        'app.schools',
        'app.users',
        'app.countries',
        'app.settings',
        'app.classrooms',
        'app.results',
        'app.resultcategories',
        'app.students',
        'app.teachers',
        'app.studentattendances',
        'app.seenotifications',
        'app.notifications',
        'app.guardians',
        'app.guardiandeviceids',
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
        'app.mobilelocals',
        'app.homeworks',
        'app.homeworkquestions',
        'app.holidays'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
