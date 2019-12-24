<?php
require_once('C:\wamp64\www\E-Commerce-Website-With-PHP-OOP-master\lib\Database.php');


class DatabaseTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    public static $db;
    protected function _before()
    {
        self::$db = new \Database();
    }

    protected function _after()
    {
        
    }

    // tests
    public function testConnection()
    {
    // create an instance of database class
        $this->assertTrue(self::$db->connectDB());
        //$this->assertFalse($db->select('select * from ahmed'));
    }
    public function testSelect()
    {
    // create an instance of database class
        $SelectResult = self::$db->select('select catId from tbl_category');
        $this->assertCount(12, $SelectResult, "count is true");
    }

     public function testInsert()
    {
    // create an instance of database class
        $brandName = 'Infinix';
        $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
        $Insertion = self::$db->insert($query);
        $this->assertTrue($Insertion,"insertion done");
    }
    
    public function testUpdate()
    {
        // select the last element then update it
        $Last_element;
        $SelectResult = self::$db->select('select brandId from tbl_brand');

        while($Row = $SelectResult->fetch_array(MYSQLI_NUM)){
            $Last_element = $Row; 
        }
        $brandName = 'Motorela';
        $brandId = $Last_element[0];
        
        $query = "UPDATE tbl_brand
        SET
        brandName = '$brandName'
        WHERE brandId = '$brandId'";

        $update = self::$db->update($query);

        // create an instance of database class
        $this->assertTrue($update, "update done");
        //$this->assertFalse($db->select('select * from ahmed'));
    }
    
    public function testDelete()
    {

        // select the last element then delete it
        $Last_element;
        $SelectResult = self::$db->select('select brandId from tbl_brand');

        while($Row = $SelectResult->fetch_array(MYSQLI_NUM)){
            $Last_element = $Row; 
        }
        $brandName = 'Motorela';
        $brandId = $Last_element[0];

    // create an instance of database class
            $query = "DELETE FROM tbl_brand WHERE brandId = '$brandId'";
            $del = self::$db->delete($query);
            $this->assertTrue($del, "item ${brandId} deleted successfully");
        
    }

}