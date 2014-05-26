<?php
/**
 *    This file is part of the OXID module certification tool
 *
 *    The OXID module certification tool is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    The OXID module certification tool is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    For further details, see <http://www.gnu.org/licenses/>.
 *
 * @link      http://www.oxid-esales.com
 * @package   OXID module certification tool
 * @copyright (C) OXID eSales AG 2003-2014
 */

require_once realpath( __DIR__ . '/../../../core/oeUseGlobals.php' );

/**
 * Class oeUseGlobalsTest: Test the class that uses globals
 */
class oeUseGlobalsTest extends PHPUnit_Framework_TestCase {

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

    /**
     * Test the getFromPost method with a unknown value
     *
     * @return null
     */
    public function testGetFromPost()
    {
        $oTestClass = new oeUseGlobals();
        $this->assertNull( $oTestClass->getFromPost( 'name' ) );
    }

    /**
     * Test the getFromPost method with a set value
     *
     * @return null
     */
    public function testGetFromPostValidValue()
    {
        $_POST['name'] = 'foobar';

        $oTestClass = new oeUseGlobals();
        $this->assertEquals( 'foobar', $oTestClass->getFromPost( 'name' ) );
    }
}
