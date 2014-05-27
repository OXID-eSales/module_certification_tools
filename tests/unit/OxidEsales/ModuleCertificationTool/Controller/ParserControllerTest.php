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

namespace OxidEsales\ModuleCertificationTool\Controller;

use PHPUnit_Framework_TestCase;

class ParserControllerTest extends PHPUnit_Framework_TestCase {

    public function testXmlCreator() {
        $oTestObject = new ParserController();
        $oXml = $oTestObject->getXmlObjectFromFile( 'unit/testdata/plainTestMdNoNamespaces.xml' );
        $this->assertInstanceOf( '\\SimpleXMLElement', $oXml );
    }

    public function testFileCleanup() {
        $oTestObject = new ParserController();
        copy( 'unit/testdata/plainTestMdWithNamespaces.xml', 'unit/testdata/testcopy.xml' );
        $oTestObject->cleanUpXmlFile( 'unit/testdata/testcopy.xml' );
        $this->assertEquals( file_get_contents( 'unit/testdata/plainTestMdNoNamespaces.xml' ), file_get_contents( 'unit/testdata/testcopy.xml' ) );
        unlink( 'unit/testdata/testcopy.xml' );
    }

} 