class Comparetests_Test extends PHPUnit_Framework_TestCase
{
 
    public function testGetMaxPoints()
    {
        $comp_test = new CompareTest(2, 27, 2);
 
        $this->assertEquals($product->getMaxPoints(), 54);
    }
 
}


