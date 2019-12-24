<?php 

require_once('C:\wamp64\www\E-Commerce-Website-With-PHP-OOP-master\classes\Cart.php');


class CartTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    public static $cart;

    protected function _before()
    {
        self::$cart = new \Cart();
    }

    protected function _after()
    {
    }

    // tests
    public function testAddToCart()
    {
        $productId = 10;
        $quantity = 12;
        $result = self::$cart->addToCart($quantity, $productId);

        if($result){
            $this->assertEquals("Product Already Added", $result);
        } else{
            $this->assertNull($result);
        }
    }

    public function testGetCart(){

        $mycart = self::$cart->getCartProduct(null);

        $this->assertNotNull($mycart);
    }



    public function testUpdateCartQunatity(){
        $cartId = 2;
        $cartQuantity = rand(5,15); // generating random quantity number
        $mycart = self::$cart->updateCartQuantity($cartId, $cartQuantity);
        $this->assertNull($mycart);
        // if it did not delete the item an exception occurs
    }

    // we can escape test delete to see the effect of updating :D
    public function testDeletACart(){
        //$this->markTestSkipped('making a skipped AssertionTest');
        $result = self::$cart->delCustomerCart();
        $this->assertNull($result);
        // if it did not delete the item an exception occurs
    }




    

}