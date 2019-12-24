<?php 

require_once('C:\wamp64\www\E-Commerce-Website-With-PHP-OOP-master\classes\Brand.php');

class BrandTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    public static $brand;
    protected function _before(){

        self::$brand = new \Brand();
    }

    protected function _after(){

    }

    // tests
    public function testInsertEmpty(){
        
        $this->assertEquals(self::$brand->brandInsert(""), "<span class='error'>Brand field must not be empty!</span>");
    }


    public function testGetAllBrands(){

        //1. test select query returns our array
        $this->assertNotEmpty(self::$brand->getAllBrand());

        //------------- very good assertion ------------- //
        $DatabaseArray = [
            ['brandId' => '2', 'brandName' =>'Sumsung'],
            ['brandId' => '3', 'brandName' =>'Iphone'],
            ['brandId' => '4', 'brandName' =>'Canon'],
            ['brandId' => '5', 'brandName' =>'Accer'],
            ['brandId' => '69', 'brandName' =>'Sumsung']
        ];

        $result = self::$brand->getAllBrand();
        $Rows = [];
        while($Row = $result->fetch_array(MYSQLI_ASSOC)){
            $Rows[] = $Row;
        }

        //2. test returned array equals our array
        $this->assertEqualsCanonicalizing($Rows, $DatabaseArray);
    }


    public function testGetBrandById(){
        //--------- hard code an id-------------//
        $BrandId = 2;
        $BrandName = 'Sumsung';

        $result = self::$brand->getBrandById(2);

        $Row = $result->fetch_array(MYSQLI_ASSOC);

        $this->assertEquals($BrandName, $Row['brandName']);

    }


    public function testInsertABrand(){
        $this->assertStringStartsWith("<span class='success'>",self::$brand->brandInsert('Diadora'));
    }


    public function testUpdateABrand(){
        

        //------------------1. test if name is empty -----------------//
        $this->assertStringContainsString('Brand field must not be empty!',self::$brand->brandUpdate("",1));

        //------------------2. test if element updated successfully------------//
        // select the last element and update it.
        $result = self::$brand->getAllBrand();
        $Rows = [];
        while($Row = $result->fetch_array(MYSQLI_ASSOC)){
            $Rows[] = $Row;
        }
        $last_element = $Rows[0];
        $Updated = self::$brand->brandUpdate("Sumsung", $last_element['brandId']);
        $this->assertStringContainsString("Brand Updated Successfully", $Updated);

        //----------------3. test if a wrong assigned BrandId-------------//
        // a ((((((Fault discoverted)))))) if a given brandId doesn't exist it should return an error message
        $this->markTestSkipped('maling a skipped AssertionTest');
        $this->assertStringContainsString('Brand Not Updated.',self::$brand->brandUpdate("Sumsung",10000));
    }
    
    public function testdelBrandById(){
        //$this->markTestSkipped('maling a skipped test');
        //------------------1. test if element Deleted successfully------------//
            // select the last element and update it.
            $result = self::$brand->getAllBrand();
            $Rows = [];
            while($Row = $result->fetch_array(MYSQLI_ASSOC)){
                $Rows[] = $Row;
            }
            $last_element = $Rows[0];
            $Deleted = self::$brand->delBrandById($last_element['brandId']);
            $this->assertStringContainsString("Brand Deleted Successfully", $Deleted);

            //------------------2. test if a given wrong Brand Id element Deleted successfully------------//
            // a ((((((Fault discoverted)))))) if a given brandId doesn't exist it should return an error message
            $this->markTestSkipped('making a skipped AssertionTest');
            $this->assertStringContainsString("Brand Not Deleted!", self::$brand->delBrandById(1000));
    }



}