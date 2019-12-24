<?php 

require_once('C:\wamp64\www\E-Commerce-Website-With-PHP-OOP-master\classes\Adminlogin.php');


class AdminloginTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    public static $Adminlogin;

    protected function _before()
    {
        self::$Adminlogin = new \Adminlogin();
    }

    protected function _after()
    {
    }

    // tests
    public function testAdminFalseData()
    {
        $AdminUser = "admin";
        $AdminPassword = "0000";

        // if login data is not correct it returns a string
        $this->assertIsString(self::$Adminlogin->adminLogin($AdminUser, $AdminPassword));
    }

    public function testAdminTrueData(){
        $AdminUser = "admin";
        $AdminPassword = '202cb962ac59075b964b07152d234b70';
        $this->assertTrue(self::$Adminlogin->adminLogin($AdminUser, $AdminPassword));

    }
}