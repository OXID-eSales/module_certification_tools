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

namespace OxidEsales\ModuleCertificationTool\Model;

use PHPUnit_Framework_TestCase;
use OxidEsales\ModuleCertificationTool\Result\GenericViolation;
use OxidEsales\ModuleCertificationTool\Result\FileViolation;

/**
 * Class GenericViolationTest: Test the getters and setters of GenericViolation class
 *
 * @package OxidEsales\ModuleCertificationTool\Result
 */
class ViolationTest extends PHPUnit_Framework_TestCase
{

    /**
     * Tests the getter of violations.
     *
     * @return null
     */
    public function testGetViolations()
    {
        $violation = new violation( array(), 'string' );
    }

    /**
     * Tests the getter of templates.
     *
     * @return null
     */
    public function testGetTemplate()
    {
        $template  = 'string';
        $violation = new violation( $this->getTestViolations(), $template );
        $this->assertEquals( $violation->getTemplate(), $template );
    }

    /**
     * Tests the getter/setter of heading.
     *
     * @return null
     */
    public function testSetGetHeading()
    {
        $template  = 'string';
        $heading   = 'header';
        $violation = new violation( $this->getTestViolations(), $template );
        $violation->setHeading( $heading );
        $this->assertEquals( $violation->getHeading(), $heading );
    }

    /**
     * Tests the getter of html.
     *
     * @return null
     */
    public function testGetHtmlForGenericViolationList()
    {
        $template  = 'genericViolationList';
        $heading   = 'header 1';
        $violation = new violation( $this->getTestViolations(), $template );
        $violation->setHeading( $heading );
        $html = '<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">header 1</h3>
    </div>
    <div class="panel-body">
                    <ul>
                <li >File example.php uses global variables</li>
            </ul>
            </div>
</div>';
        $this->assertEquals( $violation->getHtml(), $html );
    }

    /**
     * Tests the getter of html.
     *
     * @return null
     */
    public function testGetHtmlForFileViolationTable()
    {
        $template  = 'fileViolationTable';
        $heading   = 'header 1';
        $violation = new violation( $this->getTestViolations2(), $template );
        $violation->setHeading( $heading );
        $html = '<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">header 1</h3>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Class</th>
            <th>Method</th>
            <th>Line</th>
        </tr>
        </thead>
        <tbody>
                    <tr>
                <td>ExampleClass</td>
                <td>getExample()</td>
                <td>69</td>
            </tr>
                </tbody>
    </table>
</div>';
        $this->assertEquals( $html, $violation->getHtml() );
    }

    private function getTestViolations()
    {
        $genericViolation = new GenericViolation();
        $genericViolation->setMessage( 'File example.php uses global variables' );
        $testViolations    = array();
        $testViolations[ ] = $genericViolation;

        return $testViolations;
    }

    private function getTestViolations2()
    {
        $fileViolation = new FileViolation();
        $fileViolation->setFile( '/htdocs/example.php' );
        $fileViolation->setClass( 'ExampleClass' );
        $fileViolation->setMethod( 'getExample()' );
        $fileViolation->setBeginLine( '69' );
        $fileViolation->setEndLine( '666' );
        $fileViolation->setRule( 'Important Rule' );
        $testViolations    = array();
        $testViolations[ ] = $fileViolation;

        return $testViolations;
    }
}
