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
        $dsn = sprintf("sqlite:%s", realpath(DEV_DATABASE_FILE));
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
    
    /**
     * add test method, use: setUp()
     */
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
    
    /**
     * delete test method, use: tearDown()
     */    
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
    
    /**
     * generate product Mock method, use: setUp()
     */ 
    public function getProductMockObject()
    {
        return $this
            ->getMockBuilder('LegacyProductRefact\\Homework05\\Product')
            ->setMethods(array())
            ->getMock();
    }    
    
    //// Test getByEan ////
    
    /**
     * test GetByEan ean parameter
     *
     * @return Product
     */    
    public function testGetByEanValueEan()
    {        
        $product = $this->productDao->getByEan(self::TEST_EAN_VALUE);
        
        $this->assertEquals(self::TEST_EAN_VALUE, $product->ean);
        
        return $product;
    }

    /**
     * test GetByEan name parameter
     *
     * @depends testGetByEanValueEan
     */
    public function testGetByEanValueName($product)
    {
        $this->assertEquals(self::TEST_EAN_NAME_VALUE, $product->name);
    }

    /**
     * test GetByEan ean parameter with Null Product
     *
     * @return Product
     */ 
    public function testGetByEanValueEanReturnNullProduct()
    {        
        $product = $this->productDao->getByEan('schmetterling');
        
        $this->assertEquals(null, $product->ean);
        
        return $product;
    }
    
    /**
     * test GetByEan name parameter with Null Product
     *
     * @depends testGetByEanValueEanReturnNullProduct
     */
    public function testGetByEanValueNameReturnNullProduct($product)
    {
        $this->assertEquals(null, $product->name);
    }
    
    //// Test getById ////
    /**
     * test GetById ean parameter
     *
     * @return Product
     */  
    public function testGetByIdValueEan()
    {        
        $product = $this->productDao->getById(1);
        
        $this->assertEquals(self::TEST_EAN_VALUE, $product->ean);
        
        return $product;
    }
    
    /**
     * test GetById name parameter
     *
     * @depends testGetByIdValueEan
     */
    public function testGetByIdValueName($product)
    {
        $this->assertEquals(self::TEST_EAN_NAME_VALUE, $product->name);
    }
    
    /**
     * test GetById ean parameter with Null Product
     *
     * @return Product
     */ 
    public function testGetByIdValueEanReturnNullProduct()
    {        
        $product = $this->productDao->getById(0);
        
        $this->assertEquals(null, $product->ean);
        
        return $product;
    }
    
    /**
     * test GetById name parameter with Null Product
     *
     * @depends testGetByIdValueEanReturnNullProduct
     */
    public function testGetByIdValueNameReturnNullProduct($product)
    {
        $this->assertEquals(null, $product->name);
    }

    //// Test create ////
    
    /**
     * test create with Existing record
     */
    public function testCreateWithExistingRecord()
    {        
        $this->productMock->ean  = self::TEST_EAN_VALUE;
        $this->productMock->name = self::TEST_EAN_NAME_VALUE;
        
        $this->assertEquals(false, $this->productDao->create($this->productMock));
    }
    
    /**
     * test create with non Existent record
     */
    public function testCreateWithNonExistentRecord()
    {
        $this->productMock->ean  = '909090';
        $this->productMock->name = 'owl';
            
        $this->assertEquals(true, $this->productDao->create($this->productMock));
        
        $this->deleteTestRecord($this->productMock->ean, $this->productMock->name);
    }
    
    //// Test modify ////
    
    /**
     * test modify with Existing record
     */
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

    /**
     * test create with non Existent record
     */
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
    
    /**
     * test delete with Existing record
     */
    public function testDeleteWithExistingRecord()
    {        
        $this->productMock->id = 1;
        
        $this->productDao->delete($this->productMock);
        
        $product = $this->productDao->getByEan(self::TEST_EAN_VALUE);
        
        $this->assertNull($product->name);
    }
}
