<?php

namespace HandleOrder\Test\HandleOrder;

use HandleOrder\HandleOrder\HandleOrder;

use HandleOrder\HandleOrder\HandleOrderDaoFake;
use HandleOrder\HandleOrder\HandleOrderDoFake;

class HandleOrderTest extends \PHPUnit_Framework_TestCase
{
    private $handleOrder;
    private $handleOrderDoStub;
    private $handleOrderDaoStub;
    private $handleOrderDoMock;
    private $handleOrderDaoMock;

    public function setUp()
    {
        $this->handleOrder = new HandleOrder();
        
        $this->handleOrderDoStub = $this->getHandleOrderDoStub();
        $this->handleOrderDaoStub = $this->getHandleOrderDaoStub();
        
        $this->handleOrderDoMock = $this->getHandleOrderDoMock();
        $this->handleOrderDaoMock = $this->getHandleOrderDaoMock();
    }

    public function tearDown()
    {
        unset($this->handleOrder);
    }
    
    public function getHandleOrderDoStub()
    {
        return $this
            ->getMockBuilder('HandleOrder\\HandleOrder\\HandleOrderDoStub')
            ->setMethods(array())
            ->getMock();
    }
    
    public function getHandleOrderDaoStub()
    {
        return $this
            ->getMockBuilder('HandleOrder\\HandleOrder\\HandleOrderDaoStub')
            ->setMethods(array())
            ->getMock();
    }
    
    public function getHandleOrderDoMock()
    {
        return $this
            ->getMockBuilder('HandleOrder\\HandleOrder\\HandleOrderDoMock')
            ->setMethods(array())
            ->getMock();
    }
    
    public function getHandleOrderDaoMock()
    {
        return $this
            ->getMockBuilder('HandleOrder\\HandleOrder\\HandleOrderDaoMock')
            ->setMethods(array())
            ->getMock();
    }
    
    public function testHandleOrderDummy()
    {
        $handleOrderDoDummy = $this
            ->getMockBuilder('HandleOrder\\HandleOrder\\HandleOrderDoDummy')
            ->setMethods(array())
            ->getMock();
            
        $handleOrderDaoDummy = $this
            ->getMockBuilder('HandleOrder\\HandleOrder\\HandleOrderDaoDummy')
            ->setMethods(array())
            ->getMock();
        
        $this->assertTrue($this->handleOrder->handleOrderDummy($handleOrderDoDummy, $handleOrderDaoDummy));
    }
    
    public function testHandleOrderFake()
    {
        $handleOrderDoFake  = new HandleOrderDoFake();
        $handleOrderDaoFake = new HandleOrderDaoFake();
        
        $this->handleOrder->handleOrderFake($handleOrderDoFake, $handleOrderDaoFake);
    }
    
    public function testHandleOrderStubSaveAnswerTrue()
    {
        $this->handleOrderDaoStub->method('save')
            ->willReturn(true);
            
        $this->assertTrue($this->handleOrder->handleOrderStub($this->handleOrderDoStub, $this->handleOrderDaoStub));
    }
    
    /**
     * @expectedException \PDOException
     */
    public function testHandleOrderStubSaveAnswerException()
    {
        $this->handleOrderDaoStub->method('save')
            ->will($this->throwException(new \PDOException('Not Unique Record')));
            
        $this->handleOrder->handleOrderStub($this->handleOrderDoStub, $this->handleOrderDaoStub);
    }
    
    public function testHandleOrderMockSaveAnswerTrue()
    {
        $this->handleOrderDaoMock
            ->expects($this->once())
            ->method('save')
            ->with($this->handleOrderDoMock)
            ->will($this->returnValue(true));
        
        $this->handleOrder->handleOrderMock($this->handleOrderDoMock, $this->handleOrderDaoMock);
    }
    
    /**
     * @expectedException \PDOException
     */
    public function testHandleOrderMockSaveAnswerException()
    {
        $this->handleOrderDaoMock
            ->expects($this->once())
            ->method('save')
            ->with($this->handleOrderDoMock)
            ->will($this->throwException(new \PDOException('Not Unique Record')));
        
        $this->handleOrder->handleOrderMock($this->handleOrderDoMock, $this->handleOrderDaoMock);
    }
}
 