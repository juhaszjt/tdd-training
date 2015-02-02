<?php
namespace HandleOrder\HandleOrder;

use HandleOrder\HandleOrder\HandleOrderDoFake;
use HandleOrder\HandleOrder\HandleOrderDaoFake;

class HandleOrder
{
    public function handleOrderDummy(HandleOrderDoDummy $handleOrderDoDummy, HandleOrderDaoDummy $handleOrderDaoDummy) 
    {
        $handleOrderDaoDummy->save($handleOrderDoDummy);
        
        return true;
    }
    
    public function handleOrderFake(HandleOrderDoFake $handleOrderDoFake, HandleOrderDaoFake $handleOrderDaoFake)
    {
        return $handleOrderDaoFake->save($handleOrderDoFake);
    }
    
    public function handleOrderStub(HandleOrderDoStub $handleOrderDoStub, HandleOrderDaoStub $handleOrderDaoStub)
    {
        return $handleOrderDaoStub->save($handleOrderDoStub);
    }
    
    public function handleOrderMock(HandleOrderDoMock $handleOrderDoMock, HandleOrderDaoMock $handleOrderDaoMock)
    {
        return $handleOrderDaoMock->save($handleOrderDoMock);
    }
}