<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 12/10/2014
 * Time: 20:46
 */

namespace DoorsPractice\Practice04;

class Doors
{
    private $doorsList = array();

    /**
     * @return array
     */
    public function getDoorsList()
    {
        return $this->doorsList;
    }

    public function addDoorToList($opened)
    {
        if (is_bool($opened))
        {
            $this->doorsList[] = $opened;
        }
        else
        {
            throw new \InvalidArgumentException;
        }
    }

    public function initializeDoorsList($doorNumber, $doorStatus)
    {
        for($index = 1; $index <= $doorNumber; $index++)
        {
            $this->addDoorToList($doorStatus);
        }
    }

    public function setDoorStatusToInverse($index)
    {
        if (is_int($index) && $index >= 0)
        {
            $this->doorsList[$index] = !$this->doorsList[$index];
        }
        else
        {
            throw new \InvalidArgumentException;
        }
    }

    public function processDoors($doorNumber, $doorStatus)
    {
        $this->initializeDoorsList($doorNumber, $doorStatus);

        for ($index = 0; $index < $doorNumber; ++$index)
        {
            for ($doorIndex = 0; $doorIndex < $doorNumber; ++$doorIndex)
            {
                if (($doorIndex + 1) % ($index + 1) == 0)
                {
                    $this->setDoorStatusToInverse($doorIndex);
                }
            }
        }

        for ($index = 0; $index < $doorNumber; ++$index)
        {
            if ($this->doorsList[$index] === true)
            {
                print $index + 1 . '. door is open<br />';
                // 1. door is open<br />4. door is open<br />9. door is open<br />16. door is open<br />25. door is open<br />
                // 36. door is open<br />49. door is open<br />64. door is open<br />81. door is open<br />100. door is open<br />
            }
        }
    }
}