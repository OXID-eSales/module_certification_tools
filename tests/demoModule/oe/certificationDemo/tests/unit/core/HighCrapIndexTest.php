<?php
/**
 *    This file is part of the OXID module certification tool
 *    The OXID module certification tool is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *    The OXID module certification tool is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *    For further details, see <http://www.gnu.org/licenses/>.
 *
 * @link          http://www.oxid-esales.com
 * @package       OXID module certification tool
 * @copyright (C) OXID eSales AG 2003-2014
 */

require_once realpath( __DIR__ . '/../../../core/HighCrapIndex.php' );

/**
 * Class HighCrapIndexTest: This test only covers % of method to get a crap index higher than 30.
 */
class HighCrapIndexTest extends PHPUnit_Framework_TestCase
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

    public function testCreateHighCrap()
    {
        $oTest = new HighCrapIndex();

        $oTest->createHighCrap();

    }
}
