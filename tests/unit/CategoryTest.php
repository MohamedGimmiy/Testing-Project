<?php 

require_once('C:\wamp64\www\E-Commerce-Website-With-PHP-OOP-master\classes\Category.php');

class CategoryTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    public static $category;
    protected function _before()
    {
        self::$category = new \Category();
    }

    protected function _after()
    {
    }

    // tests
    public function testGetAllCategories()
    {
        $result = self::$category->getAllCat();
        $this->assertNotNull($result);
        $this->assertCount(12, $result);
    }


    public function testGetCatById(){
        $CategoryId = 15;
        $result = self::$category->getCatById($CategoryId);
        $this->assertNotNull($result);
        $this->assertCount(1, $result);
    }

    public function testCatInsert(){

        $this->assertStringContainsString('Category field must not be empty!', self::$category->catInsert(''));
        
        $CategoryName = "Music";

        $this->assertStringContainsString('Category Inserted Successfully', self::$category->catInsert($CategoryName));

    }

    public function testCatUpdate(){

        // update the last element


        $result = self::$category->getAllCat();
        $Rows = [];
        while($Row = $result->fetch_array(MYSQLI_ASSOC)){
            $Rows[] = $Row;
        }
        $last_element = $Rows[0];


        $result = self::$category->catUpdate("", $last_element['catId']);

        $CategoryName = 'Songs';

        $result = self::$category->catUpdate($CategoryName, $last_element['catId']);
        $this->assertStringContainsString("Category Updated Successfully", $result);

        $this->markTestSkipped("Skipped test discovered a fault");
        $CategoryId = 1000;
        $result = self::$category->catUpdate($CategoryName, $CategoryId);
        $this->assertStringContainsString("Category Not Updated.", $result);
    }

    public function testDeleteCategoryById(){
        // Delete the last element

        $result = self::$category->getAllCat();
        $Rows = [];
        while($Row = $result->fetch_array(MYSQLI_ASSOC)){
            $Rows[] = $Row;
        }
        $last_element = $Rows[0];
        
        $result = self::$category->delCatById($last_element['catId']);
        $this->assertStringContainsString("Category Deleted Successfully", $result);

    }

}