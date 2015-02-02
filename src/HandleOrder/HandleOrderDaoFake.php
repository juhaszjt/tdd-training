<?php

namespace HandleOrder\HandleOrder;

use HandleOrder\HandleOrder\HandleOrderDoFake;

class HandleOrderDaoFake
{
    public $ids = array();

    public function save(HandleOrderDoFake $handleOrderDoFake)
    {
        $orderNumber = $handleOrderDoFake->orderNumber;
        $totalAmount = $handleOrderDoFake->totalAmount;

        $this->checkUniqueRecord($orderNumber);
        
        return true;
    }

    protected function checkUniqueRecord($orderNumber)
    {
        if (in_array($orderNumber, $this->ids))
        {
            throw new \PDOException('Not Unique Record');
        }

        $this->ids[] = $orderNumber;
    }
}