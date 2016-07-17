<?php
namespace App\Test\TestCase\Controller\Apischool;

use App\Controller\Apischool\StudentsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\Apischool\StudentsController Test Case
 */
class StudentsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.students',
        'app.schools',
        'app.users',
        'app.areas',
        'app.cities',
        'app.states',
        'app.countries',
        'app.classrooms',
        'app.results',
        'app.resultcategories',
        'app.subjects',
        'app.timetables',
        'app.teachers',
        'app.studentattendances',
        'app.teacherattendances',
        'app.teachersalaries',
        'app.events',
        'app.classrooms_teachers',
        'app.schoolfees',
        'app.students_schoolfees',
        'app.studentfees',
        'app.holidays',
        'app.homeworks',
        'app.homeworkquestions',
        'app.guardians'
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
