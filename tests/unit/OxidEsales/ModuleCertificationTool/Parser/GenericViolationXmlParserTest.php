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

class GenericViolationXmlParserTest extends PHPUnit_Framework_TestCase {

    public function testXmlCreator() {
        $testObject = new MdXmlParser();
        $xml = $testObject->getXmlObjectFromFile( 'unit/testdata/plainTestMdNoNamespaces.xml' );
        $this->assertInstanceOf( '\\SimpleXMLElement', $xml );
    }

    public function testXmlCreator_FileNotFound() {
        $this->setExpectedException( '\Exception' );
        $testObject = new MdXmlParser();
        $testObject->getXmlObjectFromFile( 'unit/testdata/blablubb.###' );
    }

    public function test() {
        $xml = '<?xml version="1.0" encoding="UTF-8"?><result type="warning"><failures><failure>Test</failure></failures></result>';
        $testObject = new GenericViolationXmlParser();
        $violationList = $testObject->parse( simplexml_load_string( $xml ) );

        $this->assertEquals( 1, count( $violationList ) );
        $this->assertInstanceOf( '\\OxidEsales\\ModuleCertificationTool\\Result\\GenericViolation', $violationList[ 0 ] );
        $this->assertEquals( 'Test', $violationList[ 0 ]->getMessage() );
    }
}
