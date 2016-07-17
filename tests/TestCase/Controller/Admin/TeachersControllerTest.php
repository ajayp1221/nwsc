<?php
namespace App\Test\TestCase\Controller\Admin;

use App\Controller\Admin\TeachersController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\Admin\TeachersController Test Case
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
        'app.cities',
        'app.states',
        'app.countries',
        'app.studentattendances',
        'app.students',
        'app.teacherattendances',
        'app.teachersalaries',
        'app.timetables',
        'app.classrooms',
        'app.classrooms_teachers'
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
