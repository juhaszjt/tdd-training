<?php
namespace HandleOrder\Test\HandleOrder;

use HandleOrder\HandleOrder\HandleOrderDaoFake;
use HandleOrder\HandleOrder\HandleOrderDoFake;

class HandleOrderDaoFakeTest extends \PHPUnit_Framework_TestCase
{
    private $handleOrderDaoFake;

    public function setUp()
    {
        $this->handleOrderDaoFake = new HandleOrderDaoFake();
    }

    public function tearDown()
    {
        unset($this->handleOrderDaoFake);
    }

    public function testHandleOrderDaoFakeSaveMethodAnswerTrue()
    {
        $handleOrderDoFake = new HandleOrderDoFake();
        $handleOrderDoFake->orderNumber = 6;
        
        $this->assertEquals(true, $this->handleOrderDaoFake->save($handleOrderDoFake));
    }

    /**
     * @dataProvider testHandleOrderDaoFakeSaveMethodAnswerFalseDataProvider
     * @expectedException \PDOException
     */
    public function testHandleOrderDaoFakeSaveMethodAnswerFalse($orderNumbers)
    {
        $handleOrderDoFake = new HandleOrderDoFake();
        
        list($orderNumberFirst, $orderNumberSecond) = $orderNumbers;
        
        $handleOrderDoFake->orderNumber = $orderNumberFirst;
        
        $this->handleOrderDaoFake->save($handleOrderDoFake);
        
        $handleOrderDoFake->orderNumber = $orderNumberSecond;
        
        $this->handleOrderDaoFake->save($handleOrderDoFake);
    }
    
    public function testHandleOrderDaoFakeSaveMethodAnswerFalseDataProvider()
    {
        return array(
            array(6, 6),
            array(7, 7),
        );
    }
}
 