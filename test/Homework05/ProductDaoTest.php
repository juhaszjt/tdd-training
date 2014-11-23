<?php

namespace LegacyProductRefact\Test\Homework05;

use LegacyProductRefact\Homework05\ProductDao;

chdir(dirname(__FILE__));

define('DEV_DATABASE_FILE', './product_dev.db');

class ProductDaoTest extends \PHPUnit_Framework_TestCase
{
    private $productDao;
    private $productMock;
    private $pdo;

    const TEST_EAN_VALUE      = 'TestEan';
    const TEST_EAN_NAME_VALUE = 'TestEanName';

    public function setUp()
    {
        $dsn = sprintf("sqlite:%s", DEV_DATABASE_FILE);
        $this->pdo = new \PDO($dsn);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        
        $this->addTestRecord();
        
        $this->productDao = new ProductDao($this->pdo);
        
        $this->productMock = $this->getProductMockObject();
    }
    
    public function tearDown()
    {
        $this->deleteTestRecord(self::TEST_EAN_VALUE, self::TEST_EAN_NAME_VALUE);
        
        unset($this->productDao);
        unset($this->pdo);
    }
    
    private function addTestRecord()
    {
        $sth = $this->pdo->prepare("
            INSERT INTO product
                (ean, name)
            VALUES
                (:ean, :name)
        ");
                
        $sth->execute(
            array(
                ':ean'  => self::TEST_EAN_VALUE,
                ':name' => self::TEST_EAN_NAME_VALUE,
            )
        );
    }
    
    private function deleteTestRecord($ean, $name)
    {
        $sth = $this->pdo->prepare("DELETE FROM product WHERE ean = :ean AND name = :name");

        $sth->execute(
            array(
                ':ean'  => $ean,
                ':name' => $name,
            )
        );
    }
    
    public function getProductMockObject()
    {
        return $this
            ->getMockBuilder('LegacyProductRefact\\Homework05\\Product')
            ->setMethods(array())
            ->getMock();
    }    
    
    //// Test getByEan ////
    
    public function testGetByEanValueEan()
    {        
        $product = $this->productDao->getByEan(self::TEST_EAN_VALUE);
        
        $this->assertEquals(self::TEST_EAN_VALUE, $product->ean);
        
        return $product;
    }

    /**
     * @depends testGetByEanValueEan
     */
    public function testGetByEanValueName($product)
    {
        $this->assertEquals(self::TEST_EAN_NAME_VALUE, $product->name);
    }

    public function testGetByEanValueEanReturnNullProduct()
    {        
        $product = $this->productDao->getByEan('schmetterling');
        
        $this->assertEquals(null, $product->ean);
        
        return $product;
    }
    
    /**
     * @depends testGetByEanValueEanReturnNullProduct
     */
    public function testGetByEanValueNameReturnNullProduct($product)
    {
        $this->assertEquals(null, $product->name);
    }
    
    //// Test getById ////
    
    public function testGetByIdValueEan()
    {        
        $product = $this->productDao->getById(1);
        
        $this->assertEquals(self::TEST_EAN_VALUE, $product->ean);
        
        return $product;
    }
    
    /**
     * @depends testGetByIdValueEan
     */
    public function testGetByIdValueName($product)
    {
        $this->assertEquals(self::TEST_EAN_NAME_VALUE, $product->name);
    }
    
    public function testGetByIdValueEanReturnNullProduct()
    {        
        $product = $this->productDao->getById(0);
        
        $this->assertEquals(null, $product->ean);
        
        return $product;
    }
    
    /**
     * @depends testGetByIdValueEanReturnNullProduct
     */
    public function testGetByIdValueNameReturnNullProduct($product)
    {
        $this->assertEquals(null, $product->name);
    }

    //// Test create ////
    
    public function testCreateWithExistingRecord()
    {        
        $this->productMock->ean  = self::TEST_EAN_VALUE;
        $this->productMock->name = self::TEST_EAN_NAME_VALUE;
        
        $this->assertEquals(false, $this->productDao->create($this->productMock));
    }
    
    public function testCreateWithNonExistentRecord()
    {
        $this->productMock->ean  = '909090';
        $this->productMock->name = 'owl';
            
        $this->assertEquals(true, $this->productDao->create($this->productMock));
        
        $this->deleteTestRecord($this->productMock->ean, $this->productMock->name);
    }
    
    //// Test modify ////
    
    public function testModifyWithExistingRecord()
    {        
        $this->productMock->id   = 1;
        $this->productMock->ean  = self::TEST_EAN_VALUE;
        $this->productMock->name = self::TEST_EAN_NAME_VALUE . '_MODIFIED_';
        
        $this->productDao->modify($this->productMock);
        
        $product = $this->productDao->getByEan(self::TEST_EAN_VALUE);
        
        $this->assertEquals(self::TEST_EAN_NAME_VALUE . '_MODIFIED_', $product->name);

        $this->deleteTestRecord($this->productMock->ean, $this->productMock->name);
    }

    public function testModifyWithNonExistentRecord()
    {
        $this->productMock->id   = 2;
        $this->productMock->ean  = self::TEST_EAN_VALUE . '_UNIQUE_';
        $this->productMock->name = self::TEST_EAN_NAME_VALUE . '_MODIFIED_';

        $this->productDao->modify($this->productMock);

        $product = $this->productDao->getByEan($this->productMock->ean);

        $this->assertNull($product->name);
    }
    
    //// Test delete ////
    
    public function testDeleteWithExistingRecord()
    {        
        $this->productMock->id = 1;
        
        $this->productDao->delete($this->productMock);
        
        $product = $this->productDao->getByEan(self::TEST_EAN_VALUE);
        
        $this->assertNull($product->name);
    }
}
