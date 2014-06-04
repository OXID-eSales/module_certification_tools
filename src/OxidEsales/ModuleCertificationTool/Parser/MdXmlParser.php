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

use OxidEsales\ModuleCertificationTool\Result\CertificationResult;
use OxidEsales\ModuleCertificationTool\Result\CertificationRule;
use OxidEsales\ModuleCertificationTool\Result\CertificationRuleViolation;
use OxidEsales\ModuleCertificationTool\Result\FileViolation;

/**
 * Class MdXmlParser: Class for parsing the xml result files from OXMD.
 *
 * @package OxidEsales\ModuleCertificationTool\Parser
 */
class MdXmlParser
{
    /**
     * Loads a XML file into a XML object.
     *
     * @param $xmlFileName Name of the XML file
     *
     * @return \SimpleXMLElement XML object
     * @throws \Exception
     */
    public function getXmlObjectFromFile( $xmlFileName ) {
        if ( !is_file( $xmlFileName ) ) {
            throw new \Exception( 'file ' . $xmlFileName . ' was not found' );
        }
        if ( !is_readable( $xmlFileName ) ) {
            throw new \Exception( 'file ' . $xmlFileName . ' is not readable' );
        }

        $xml = simplexml_load_file( $xmlFileName );

        return $xml;
    }

    /**
     * Removes namespace stuff from a XML file to prevent SimpleXML issues.
     *
     * @param $xmlFileName The name of the XML file
     *
     * @return $this The object itself
     * @throws \Exception
     */
    public function cleanUpXmlFile( $xmlFileName ) {
        // workaround for simpleXML namespace issue
        if ( !is_file( $xmlFileName ) ) {
            throw new \Exception( 'file ' . $xmlFileName . ' was not found' );
        }
        if ( !is_readable( $xmlFileName ) ) {
            throw new \Exception( 'file ' . $xmlFileName . ' is not readable' );
        }

        $xmlString = file_get_contents( $xmlFileName );
        $xmlString = str_replace( '<oxid:', '<', $xmlString );
        $xmlString = str_replace( '</oxid:', '</', $xmlString );

        file_put_contents( $xmlFileName, $xmlString );

        return $this;
    }

    /**
     * Parses a XML object into a certification result object.
     *
     * @param \SimpleXMLElement $xml The XML object
     *
     * @return CertificationResult The parsed data
     */
    public function parse( \SimpleXMLElement $xml )
    {
        $certificationResult = new CertificationResult();

        $certificationElement = $xml->certification;
        $certificationResult->setPrice( (string )$certificationElement[ 'price' ] );
        $certificationResult->setFactor( (float)$certificationElement[ 'factor' ] );

        $certificationRules = array();

        if ( isset( $certificationElement->rule ) ) {
            foreach ( $certificationElement->rule as $ruleElement ) {
                $certificationRule = $this->parseCertificationRule( $ruleElement );
                $certificationRules[ $certificationRule->getName() ] = $certificationRule;
            }
        }

        $certificationResult->setCertificationRules( $certificationRules );

        $fileViolations = array();
        foreach ( $xml->file as $fileElement ) {
            $fileViolations = $this->parseFileViolations( $fileElement, $fileViolations );
        }
        $certificationResult->setViolations( $fileViolations );

        return $certificationResult;
    }

    /**
     * Parses the violations of a single file into a violation array.
     *
     * @param $fileElement XML element of the file
     * @param $fileViolations Already existig violations
     *
     * @return array Violation array
     */
    private function parseFileViolations( $fileElement, $fileViolations )
    {
        $sFileName = $fileElement[ 'name' ];
        foreach ( $fileElement->violation as $violationElement ) {
            $fileViolation = new FileViolation();
            $fileViolation->setFile( $sFileName );
            $fileViolation->setClass( (string)$violationElement[ 'class' ] );
            $fileViolation->setMethod( (string)$violationElement[ 'method' ] );
            $fileViolation->setBeginLine( (int)$violationElement[ 'beginline' ] );
            $fileViolation->setEndLine( (int)$violationElement[ 'endline' ] );
            $fileViolation->setRule( (string)$violationElement[ 'rule' ] );
            if ( !array_key_exists( $fileViolation->getRule(), $fileViolations ) ) {
                $fileViolations[ $fileViolation->getRule() ] = array();
            }
            $fileViolations[ $fileViolation->getRule() ][ ] = $fileViolation;
        }

        return $fileViolations;
    }

    /**
     * Parses a XML rule element into a rule object.
     *
     * @param $ruleElement XML rule element
     *
     * @return CertificationRule Rule object
     */
    private function parseCertificationRule( $ruleElement )
    {

        $certificationRule = new CertificationRule();

        $certificationRule->setName( (string)$ruleElement[ 'name' ] );
        $certificationRule->setViolated( (bool)$ruleElement[ 'violated' ] );
        $certificationRule->setValue( (int)$ruleElement[ 'value' ] );
        $certificationRule->setFactor( (float)$ruleElement[ 'factor' ] );

        $violations = array();
        foreach ( $ruleElement->file as $fileElement ) {
            $violations[ ] = $this->parseFileElement( $fileElement );
        }
        $certificationRule->setViolations( $violations );

        return $certificationRule;
    }

    /**
     * Parses a XML file element into a rule violation object
     *
     * @param $fileElement XML file element
     *
     * @return CertificationRuleViolation Rule violation object
     */
    private function parseFileElement( $fileElement )
    {
        $certificationRuleViolation = new CertificationRuleViolation();

        $certificationRuleViolation->setClass( (string)$fileElement[ 'class' ] );
        $certificationRuleViolation->setFile( (string)$fileElement[ 'file' ] );
        $certificationRuleViolation->setMethod( (string)$fileElement[ 'method' ] );
        $certificationRuleViolation->setLine( (int)$fileElement[ 'line' ] );
        $certificationRuleViolation->setNamespace( (string)$fileElement[ 'namespace' ] );

        return $certificationRuleViolation;
    }
}
