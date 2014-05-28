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

namespace OxidEsales\ModuleCertificationTool\Result;

use PHPUnit_Framework_TestCase;

/**
 * Class FileViolationTest: Test setters and getters of FileViolation class.
 *
 * @package OxidEsales\ModuleCertificationTool\Result
 */
class FileViolationTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test setting and getting the file name
     *
     * @return null
     */
    public function testSetGetFileName()
    {
        $fileName = 'filename';

        $fileViolation = new FileViolation();
        $fileViolation->setFile( $fileName );

        $this->assertEquals( $fileName, $fileViolation->getFile() );
    }

    /**
     * Test setting and getting the class name
     *
     * @return null
     */
    public function testSetGetClass()
    {
        $className = 'classname';

        $fileViolation = new FileViolation();
        $fileViolation->setClass( $className );

        $this->assertEquals( $className, $fileViolation->getClass() );
    }

    /**
     * Test setting and getting the method name
     *
     * @return null
     */
    public function testSetGetMethod()
    {
        $method = 'method';

        $fileViolation = new FileViolation();
        $fileViolation->setMethod( $method );

        $this->assertEquals( $method, $fileViolation->getMethod() );
    }

    /**
     * Test setting and getting the begin line
     *
     * @return null
     */
    public function testSetGetBeginLine()
    {
        $beginLine = 12;

        $fileViolation = new FileViolation();
        $fileViolation->setBeginLine( $beginLine );

        $this->assertEquals( $beginLine, $fileViolation->getBeginLine() );
    }

    /**
     * Test setting and getting the end line
     *
     * @return null
     */
    public function testSetGetEndLine()
    {
        $endLine = '18';

        $fileViolation = new FileViolation();
        $fileViolation->setEndLine( $endLine );

        $this->assertEquals( $endLine, $fileViolation->getEndLine() );
    }

    /**
     * Test setting and getting the rule
     *
     * @return null
     */
    public function testSetGetRule()
    {
        $rule = 'rulename';

        $fileViolation = new FileViolation();
        $fileViolation->setRule( $rule );

        $this->assertEquals( $rule, $fileViolation->getRule() );
    }

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
}

