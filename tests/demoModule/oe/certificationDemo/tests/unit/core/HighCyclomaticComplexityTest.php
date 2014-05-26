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

require_once realpath( __DIR__ . '/../../../core/HighCyclomaticComplexity.php' );

/**
 * Class HighCyclomaticComplexityTest: Test class for testing the high cyclomatic complexity class
 */
class HighCyclomaticComplexityTest extends PHPUnit_Framework_TestCase
{
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
     * Run through 1 tree of hasHighComplexity
     *
     * @return null
     */
    public function testFor1()
    {
        $oTestClass = new HighCyclomaticComplexity();
        $this->assertEquals( 2, $oTestClass->hasHighComplexity( 1 ) );
    }

    /**
     * Run through 2 tree of hasHighComplexity
     *
     * @return null
     */
    public function testFor2()
    {
        $oTestClass = new HighCyclomaticComplexity();
        $this->assertEquals( 2, $oTestClass->hasHighComplexity( 2 ) );
    }

    /**
     * Run through 3 tree of hasHighComplexity
     *
     * @return null
     */
    public function testFor3()
    {
        $oTestClass = new HighCyclomaticComplexity();
        $this->assertEquals( 4, $oTestClass->hasHighComplexity( 3 ) );
    }

    /**
     * Run through 4 tree of hasHighComplexity
     *
     * @return null
     */
    public function testFor4()
    {
        $oTestClass = new HighCyclomaticComplexity();
        $this->assertEquals( 4, $oTestClass->hasHighComplexity( 4 ) );
    }

    /**
     * Run through 5 tree of hasHighComplexity
     *
     * @return null
     */
    public function testFor5()
    {
        $oTestClass = new HighCyclomaticComplexity();
        $this->assertEquals( 6, $oTestClass->hasHighComplexity( 5 ) );
    }

    /**
     * Run through 6 tree of hasHighComplexity
     *
     * @return null
     */
    public function testFor6()
    {
        $oTestClass = new HighCyclomaticComplexity();
        $this->assertEquals( 6, $oTestClass->hasHighComplexity( 6 ) );
    }

    /**
     * Run through 7 tree of hasHighComplexity
     *
     * @return null
     */
    public function testFor7()
    {
        $oTestClass = new HighCyclomaticComplexity();
        $this->assertEquals( 8, $oTestClass->hasHighComplexity( 7 ) );
    }

    /**
     * Run through 8 tree of hasHighComplexity
     *
     * @return null
     */
    public function testFor8()
    {
        $oTestClass = new HighCyclomaticComplexity();
        $this->assertEquals( 8, $oTestClass->hasHighComplexity( 8 ) );
    }

    /**
     * Run through 9 tree of hasHighComplexity
     *
     * @return null
     */
    public function testFor9()
    {
        $oTestClass = new HighCyclomaticComplexity();
        $this->assertEquals( 10, $oTestClass->hasHighComplexity( 9 ) );
    }

    /**
     * Run through default tree of hasHighComplexity
     *
     * @return null
     */
    public function testForDefault()
    {
        $oTestClass = new HighCyclomaticComplexity();
        $this->assertEquals( 11, $oTestClass->hasHighComplexity( 11 ) );
    }
}
