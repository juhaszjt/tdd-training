<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 23/09/2014
 * Time: 06:41
 */

namespace Tdd\Test\Homework02;

use Tdd\Homework02\Sequence;

class SequenceTest extends \PHPUnit_Framework_TestCase
{
    private $sequence = null;

    public function testSequenceInit()
    {
        $elements = array(6, 4);

        $this->sequence = new Sequence($elements);

        $this->assertEquals($elements, $this->sequence->getElements());
    }

    /**
     * @param array $elements
     *
     * @dataProvider   validateElementsDataProvider
     */
    public function testValidateElements(array $elements)
    {
        $this->sequence = new Sequence($elements);

        $this->assertEquals(true, $this->sequence->validateElements());
    }

    /**
     * validateElements DataProvider
     *
     * @return array
     */
    public function validateElementsDataProvider()
    {
        return array(
            array(array(7, 4)),
            array(array(9, 11)),
            array(array(-1, 0)),
        );
    }

    /**
     * @param array $elements
     *
     * @dataProvider   validateElementsToFailDataProvider
     */
    public function testValidateElementsToFail(array $elements)
    {
        $this->sequence = new Sequence($elements);

        $this->assertEquals(false, $this->sequence->validateElements());
    }

    /**
     * validateElementsToFailDataProvider
     *
     * @return array
     */
    public function validateElementsToFailDataProvider()
    {
        return array(
            array(array(null, 4)),
            array(array(123, '1alma')),
            array(array('sas', 'sas')),
            array(array(7, 3.14)),
        );
    }
}
 