<?php
namespace App\Test\TestCase\Controller\Api;

use App\Controller\Api\TeachersController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\Api\TeachersController Test Case
 */
class TeachersControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.teachers',
        'app.schools',
        'app.users',
        'app.areas',
        'app.cities',
        'app.states',
        'app.countries',
        'app.classrooms',
        'app.results',
        'app.schoolfees',
        'app.studentfees',
        'app.students',
        'app.guardians',
        'app.studentattendances',
        'app.students_schoolfees',
        'app.timetables',
        'app.subjects',
        'app.classrooms_teachers',
        'app.holidays',
        'app.resultcategories',
        'app.teacherattendances',
        'app.teachersalaries'
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
