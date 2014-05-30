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

    public function testFileCleanup() {
        $testObject = new MdXmlParser();
        copy( 'unit/testdata/plainTestMdWithNamespaces.xml', 'unit/testdata/testcopy.xml' );
        $testObject->cleanUpXmlFile( 'unit/testdata/testcopy.xml' );
        $this->assertEquals( file_get_contents( 'unit/testdata/plainTestMdNoNamespaces.xml' ), file_get_contents( 'unit/testdata/testcopy.xml' ) );
        unlink( 'unit/testdata/testcopy.xml' );
    }

    public function testFileCleanup_FileNotFound() {
        $this->setExpectedException( '\Exception' );
        $testObject = new MdXmlParser();
        $testObject->cleanUpXmlFile( 'unit/testdata/blablubb.###' );
    }

    public function testParsing() {
        $xml = simplexml_load_file( 'unit/testdata/oxmd-result_short.xml' );
        $testObject = new MdXmlParser();
        $violationList = $testObject->parse( $xml );

        $this->assertInstanceOf( '\\OxidEsales\\ModuleCertificationTool\\Result\\CertificationResult', $violationList );
        $this->assertEquals( 4, $violationList->getFactor() );
        $this->assertEquals( 120, $violationList->getPrice() );

        $certificationRules = $violationList->getCertificationRules();
        $violations = $violationList->getViolations();

        $this->assertEquals( 1, count( $certificationRules ) );
        $this->assertEquals( 1, count( $violations ) );
        $this->assertEquals( 1, count( $violations[ 'Coverage' ] ) );

        $this->assertInstanceOf( '\\OxidEsales\\ModuleCertificationTool\\Result\\FileViolation', $violations[ 'Coverage' ][ 0 ] );
        $this->assertInstanceOf( '\\OxidEsales\\ModuleCertificationTool\\Result\\CertificationRule', $certificationRules[ 'Code Coverage' ] );

        /** @var \OxidEsales\ModuleCertificationTool\Result\FileViolation $violation */
        $violation = $violations[ 'Coverage' ][ 0 ];
        $this->assertEquals( 'evilController', $violation->getClass() );
        $this->assertEquals( 'evilAction', $violation->getMethod() );
        $this->assertEquals( 'Coverage', $violation->getRule() );
        $this->assertEquals( 17, $violation->getBeginLine() );
        $this->assertEquals( 26, $violation->getEndLine() );

        /** @var \OxidEsales\ModuleCertificationTool\Result\CertificationRule $certificationRule */
        $certificationRule = $certificationRules[ 'Code Coverage' ];
        $this->assertTrue( $certificationRule->getViolated() );
        $this->assertEquals( 'Code Coverage', $certificationRule->getName() );

        $ruleViolations = $certificationRule->getViolations();
        $this->assertEquals( 1, count( $ruleViolations ) );
        $this->assertInstanceOf( '\\OxidEsales\\ModuleCertificationTool\\Result\\CertificationRuleViolation', $ruleViolations[ 0 ] );

        $this->assertEquals( 'evilClass', $ruleViolations[ 0 ]->getClass() );
        $this->assertEquals( 'evilMethod', $ruleViolations[ 0 ]->getMethod() );
        $this->assertEquals( '+global', $ruleViolations[ 0 ]->getNamespace() );
        $this->assertEquals( 21, $ruleViolations[ 0 ]->getLine() );
    }

    public function testParsingFails() {
        $this->setExpectedException( 'PHPUnit_Framework_Error' );
        $testObject = new MdXmlParser();
        $violationList = $testObject->parse( (object) null );
    }
}
