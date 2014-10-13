<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 12/10/2014
 * Time: 20:15
 */

namespace DoorsPractice\Test\Practice04;

use DoorsPractice\Practice04\Doors;

class DoorsTest extends \PHPUnit_Framework_TestCase
{
    private $doors;

    public function setUp()
    {
        $this->doors = new Doors();
    }

    public function tearDown()
    {
        unset($this->doors);
    }

    public function testDoorsClassExists()
    {
        $this->assertEquals($this->doors, new Doors());
    }

    public function testDoorsListAttribute()
    {
        $attributeName = 'doorsList';
        $className = 'DoorsPractice\\Practice04\\Doors';

        $this->assertClassHasAttribute($attributeName, $className);

        $this->assertAttributeInternalType('array', $attributeName, $this->doors);

        $this->assertEmpty($this->doors->getDoorsList());

        $this->doors->addDoorToList(true);
        $this->assertNotEmpty($this->doors->getDoorsList());
    }

    /**
     * @dataProvider invalidValuesToDoorListDataProvider
     * @expectedException \InvalidArgumentException
     *
     * @param $doorStatus
     */
    public function testAddInvalidValuesToDoorListThrowsException($doorStatus)
    {
        $this->doors->addDoorToList($doorStatus);
    }

    public function invalidValuesToDoorListDataProvider()
    {
        return array(
            array(new \stdClass()),
            array('sausages'),
            array('true'),
            array(111),
            array(null),
            array(array()),
            array(new Doors())
        );
    }

    /**
     * @dataProvider countDoorsValueEqualsDataProvider
     *
     * @param array $actualDoors
     */
    public function testCountDoorsValueEquals(array $actualDoors)
    {
        foreach($actualDoors as $doorStatus) {
            $this->doors->addDoorToList($doorStatus);
        }

        $this->assertEquals(count($actualDoors), count($this->doors->getDoorsList()));
    }

    public function countDoorsValueEqualsDataProvider()
    {
        return array(
            array(array(true, false, false)),
            array(array(true, false, false, true)),
            array(array(true, false, false, true, false))
        );
    }

    /**
     * @dataProvider doorsListInitializationDataProvider
     *
     * @param array $actualDoorsParameters
     */
    public function testDoorsListInitialization(array $actualDoorsParameters)
    {
        list($doorNumber, $doorStatus) = $actualDoorsParameters;
        $this->doors->initializeDoorsList($doorNumber, $doorStatus);

        $doorsList = $this->doors->getDoorsList();
        $this->assertEquals($doorNumber, count($doorsList));
        $this->assertEquals($doorStatus, $doorsList[0]);
        $this->assertEquals($doorStatus, $doorsList[count($doorsList)-1]);

        $this->doors->setDoorStatusToInverse(5);
        $doorsList = $this->doors->getDoorsList();
        $this->assertEquals(!$doorStatus, $doorsList[5]);
    }

    public function doorsListInitializationDataProvider()
    {
        return array(
            array(array(6, false)),
            array(array(77, true))
        );
    }

    /**
     * @dataProvider invalidDoorIndexDataProvider
     * @expectedException \InvalidArgumentException
     *
     * @param $doorIndex
     */
    public function testSetInvalidDoorIndexThrowsException($doorIndex)
    {
        $this->doors->setDoorStatusToInverse($doorIndex);
    }

    public function invalidDoorIndexDataProvider()
    {
        return array(
            array(new \stdClass()),
            array('sausages'),
            array('false'),
            array(true),
            array(null),
            array(array()),
            array(-1)
        );
    }

    public function testProcessDoors()
    {
        $this->doors->processDoors(100, false);
    }
}
 