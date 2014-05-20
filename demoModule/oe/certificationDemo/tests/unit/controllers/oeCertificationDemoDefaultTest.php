<?php
/**
 * This Software is the property of OXID eSales and is protected
 * by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license key
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * @link http://www.oxid-esales.com
 * @package package_name
 * @copyright © OXID eSales AG 2003-2014
 */

require_once realpath( __DIR__ . '/../../../controllers/oeCertificationDemoDefault.php');

class oeCertificationDemoDefaultTest extends PHPUnit_Framework_TestCase {
    /**
     * Set up test environment
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * Tear down test environment
     *
     * @return null
     */
    protected function tearDown()
    {
        parent::tearDown();
    }

    public function testGet1()
    {
        $oTest = new oeCertificationDemoDefault();
        $this->assertEquals( 1, $oTest->getOne() );
    }

    public function testCallBySelectorWithA()
    {
        $oTest = new oeCertificationDemoDefault();
        $oTest->getBySelection( 'a' );
    }

//    public function testCallBySelectionWithB()
//    {
//        $oTest = new oeCertificationDemoDefault();
//        $oTest->getBySelection( 'b' );
//    }

    public function testCallBySelectionWithC()
    {
        $oTest = new oeCertificationDemoDefault();
        $oTest->getBySelection( 'c' );
    }

//    public function testCallBySelectionWithDifferent()
//    {
//        $oTest = new oeCertificationDemoDefault();
//        $oTest->getBySelection( 'x' );
//    }
}
