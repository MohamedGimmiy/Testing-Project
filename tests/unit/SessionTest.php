<?php 

require_once('C:\wamp64\www\E-Commerce-Website-With-PHP-OOP-master\lib\Session.php');


class SessionTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    public static $sessionTesting;

    protected function _before()
    {   
        self::$sessionTesting = new \Session();
    }

    protected function _after()
    {
    }

    public function testSessionExists(){
        $this->markTestSkipped("skipped");
        $this->assertTrue(self::$sessionTesting->init());
    }
    // tests
    public function testSessionValues()
    {
        //1. initiazlizing our array
        $array = ['UserName' => 'mido30',
                  'Password' => 'asd1245',
                  'Emai' => 'mizo@yahoo.com',
                  'phone' => '01016298017',
                  'other' => 'done'];

        //2. filling our session array
       foreach($array as $key => $value){
           self::$sessionTesting->set($key, $value);
       }

        //3. testing our array
        foreach($array as $key => $value){
            // test if stored values equal array values
            $this->assertEquals(self::$sessionTesting->get($key), $value);
            // test if our array contains session values 
            $this->assertContains(self::$sessionTesting->get($key), $array );

            // test if SessionArray has the stored keys
            $this->assertArrayHasKey($key,$_SESSION);
        }
    }

    public function testAdminLogin(){

        $this::$sessionTesting->destroy();

        $this::$sessionTesting->init();

        $key = 'adminlogin';
        self::$sessionTesting->set($key,true);

        $this->assertTrue(self::$sessionTesting->checkSession());
    }


    public function testAdminNotLogin(){
        // session was destroyed
        $this->assertFalse(self::$sessionTesting->checkSession());
    
    }

    public function testDestroy(){
        self::$sessionTesting->init();
        $check = self::$sessionTesting->destroy();
        $this->assertTrue($check);
    }

}