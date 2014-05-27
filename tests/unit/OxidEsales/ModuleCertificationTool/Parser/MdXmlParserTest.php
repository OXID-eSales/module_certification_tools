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

namespace OxidEsales\ModuleCertificationTool\Parser;

use PHPUnit_Framework_TestCase;

class MdXmlParserTest extends PHPUnit_Framework_TestCase {

    public function testParseFile() {
        $oTestObject = $this->getMock( '\\OxidEsales\\ModuleCertificationTool\\Parser\\MdXmlParser', array( 'parseXml' ) );
        $oTestObject->expects( $this->any() )
                    ->method( 'parseXml' )
                    ->will( $this->returnArgument( 0 ) );

        $sFilename = 'unit/testdata/plainTestMdNoNamespaces.xml';
        $sXml = $oTestObject->parse( $sFilename );

        $this->assertInstanceOf( '\\SimpleXMLElement', $sXml );
    }

    public function testParseFileWithNonExistentFile() {
        $this->setExpectedException( '\\PHPUnit_Framework_Error' );
        $sFilename = 'unit/testdata/blablubb###.xml';
        $oTestObject = new MdXmlParser();
        $sXml = $oTestObject->parse( $sFilename );
    }

    public function testParseFile_XmlNamespaceExists() {
        $oTestObject = $this->getMock( '\\OxidEsales\\ModuleCertificationTool\\Parser\\MdXmlParser', array( 'parseXml' ) );
        $oTestObject->expects( $this->any() )
                    ->method( 'parseXml' )
                    ->will( $this->returnArgument( 0 ) );

        $sFilename = 'unit/testdata/plainTestMdWithNamespaces.xml';
        $sXml = $oTestObject->parse( $sFilename );

        $this->assertInstanceOf( '\\SimpleXMLElement', $sXml );
    }







    public function testParseXML() {
        $this->markTestIncomplete();
    }

    public function testParseFileViolations() {
        $this->markTestIncomplete();
    }

    public function testParseCertificationRule() {
        $this->markTestIncomplete();
    }

    public function testParseFileElement() {
        $this->markTestIncomplete();
    }

    public function testGetViolations() {
        $this->markTestIncomplete();
    }

}
