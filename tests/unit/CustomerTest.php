<?php 

require_once('C:\wamp64\www\E-Commerce-Website-With-PHP-OOP-master\classes\Customer.php');
require_once('C:\wamp64\www\E-Commerce-Website-With-PHP-OOP-master\lib\Session.php');
/* require_once('C:\wamp64\www\E-Commerce-Website-With-PHP-OOP-master\lib\Database.php');
 */

class CustomerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    public static $Customer;
    public static $db;
    protected function _before()
    {
        self::$Customer = new \Customer();
    }

    protected function _after()
    {
        // Update the modified tested row
        $data = [
            "name" => "mohamed gamal hussin",
            "address" => "8 hassan soliman",
            "city" => "Cairo",
            "country" => "Egypt",
            "zip" => "11772",
            "phone" => "01016298017",
            "email" => "mgh_mgh100@yahoo.com",
            "pass" => "1cd8e7658bb6db26fed1ce17940b7dbd"
        ];
        $id = 4;
        $result = self::$Customer->customerUpdate($data, $id);
    }

    // tests
    public function testCustomerRegistration()
    {   
        //1. input data
        $Information = [
            "name" => "mohamed gamal hussin",
            "address" => "8 hassan soliman",
            "city" => "Cairo",
            "country" => "Egypt",
            "zip" => "11772",
            "phone" => "01016298017",
            "email" => "mgh_mgh100@yahoo.com",
            "pass" => "1cd8e7658bb6db26fed1ce17940b7dbd"
        ];

        $Information['name']='';

        //------------1. test if there is an empty field ---------------- //

        $result = self::$Customer->customerRegistration($Information);

        $this->assertStringContainsString('Fields must not be empty!',$result);

        //-----------2. test if our data exists -------------------- //

        $Information['name'] = 'mohamed gamal hussin';
        $result = self::$Customer->customerRegistration($Information);

        $this->assertStringContainsString('Email already Exist!',$result);

        //----------3. test if our data inserted successfully ----------- //

        // Customer Data Inserted Successfully
        $Information['email'] = 'mohamedhussin@gmail.com';
        $result = self::$Customer->customerRegistration($Information);
        $this->assertStringContainsString('Customer Data Inserted Successfully',$result);

    }

    public function testCustomerLogin(){

        $Information = [
            "email" => "mgh_mgh100@yahoo.com",
            "pass" => "asd1234"
        ];

        $Information['email'] = '';

        //1. test if our fields are empty
        // Fields must not be empty!
        $result = self::$Customer->customerLogin($Information);
        $this->assertStringContainsString('Fields must not be empty!',$result);

        //2. test if our email or password are not matched !
        $Information['email'] = 'mido@yahoo.com';
        $result = self::$Customer->customerLogin($Information);
        $this->assertStringContainsString('Email or Passowrd not matched!',$result);


        //3. test if our email and password are correct
        $Information['email'] = 'mgh_mgh100@yahoo.com';
        $result = self::$Customer->customerLogin($Information);
        $this->assertNull($result);
        //$this->expectException();
    }

    public function testGetCustomerData(){

        $CustomerId = 1;
        $result = self::$Customer->getCustomerData($CustomerId);
        $rows = [];

        while($row = $result->fetch_array(MYSQLI_NUM)){
            $rows[] = $row;
        }
        
        $this->assertNotNull($rows);

        $this->assertCount(1,$rows);

    }

    public function testCustomerUpdate(){
        //1. input data
        $data = [
            "name" => "mohamed gamal hussin",
            "address" => "8 hassan soliman",
            "city" => "San diago",
            "country" => "America",
            "zip" => "11772",
            "phone" => "01016298017",
            "email" => "mgh_mgh100@yahoo.com",
            "pass" => "1cd8e7658bb6db26fed1ce17940b7dbd"
        ];
        $id = 4;

        //1. test if there is any empty fields
        $data['name'] = '';
        $result = self::$Customer->customerUpdate($data, $id);
        $this->assertStringContainsString('Fields must not be empty!', $result);

        //2. test Updating data successfully
        $data['name'] = 'mohamed gamal hussin';
        $result = self::$Customer->customerUpdate($data, $id);
        $this->assertStringContainsString('Customer Data Update Successfully', $result);
    }







}