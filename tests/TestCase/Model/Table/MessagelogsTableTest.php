<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MessagelogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MessagelogsTable Test Case
 */
class MessagelogsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MessagelogsTable
     */
    public $Messagelogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.messagelogs',
        'app.messagesmslogs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Messagelogs') ? [] : ['className' => 'App\Model\Table\MessagelogsTable'];
        $this->Messagelogs = TableRegistry::get('Messagelogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Messagelogs);

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
