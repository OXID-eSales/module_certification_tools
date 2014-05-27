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

use OxidEsales\ModuleCertificationTool\Model\CertificationResult;
use OxidEsales\ModuleCertificationTool\Model\CertificationRule;
use OxidEsales\ModuleCertificationTool\Model\CertificationRuleViolation;
use OxidEsales\ModuleCertificationTool\Model\FileViolation;
use OxidEsales\ModuleCertificationTool\Model\MdResult;
use OxidEsales\ModuleCertificationTool\Violation;

/**
 * Class MdXmlParser class for the application
 */
class MdXmlParser
{

    public function parse( $xmlFileName )
    {
        // workaround for simpleXML namespace issue
        $xmlString = file_get_contents( $xmlFileName );
        if(empty($xmlString)){
            return '';
        }
        $xmlString = str_replace( '<oxid:', '<', $xmlString );
        $xmlString = str_replace( '</oxid:', '</', $xmlString );
        file_put_contents( $xmlFileName, $xmlString );

        $xml = simplexml_load_file( $xmlFileName );

        return $this->parseXml( $xml );
    }

    /**
     * @param $xml
     * @return CertificationResult
     */
    public function parseXml( $xml )
    {
        $certificationResult = new CertificationResult();

        $certificationElement = $xml->certification;
        $certificationResult->setPrice( (string )$certificationElement[ 'price' ] );
        $certificationResult->setFactor( (float)$certificationElement[ 'factor' ] );

        $certificationRules = array();

        if ( isset( $certificationElement->rule ) ) {
            foreach ( $certificationElement->rule as $oRuleElement ) {
                $oCertificationRule = $this->parseCertificationRule( $oRuleElement );
                $certificationRules[ $oCertificationRule->getName() ] = $oCertificationRule;
            }
        }

        $certificationResult->setCertificationRules( $certificationRules );

        $fileViolations = array();
        foreach ( $xml->file as $fileElement ) {
            $this->parseFileViolations( $fileElement, $fileViolations );
        }
        $certificationResult->setViolations( $fileViolations );

        return $certificationResult;
    }

    public function parseFileViolations( $fileElement, &$fileViolations )
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
    }

    /**
     * @param $ruleElement
     * @return CertificationRule
     */
    public function parseCertificationRule( $ruleElement )
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

    public function parseFileElement( $fileElement )
    {
        $certificationRuleViolation = new CertificationRuleViolation();

        $certificationRuleViolation->setClass( (string)$fileElement[ 'class' ] );
        $certificationRuleViolation->setFile( (string)$fileElement[ 'file' ] );
        $certificationRuleViolation->setMethod( (string)$fileElement[ 'method' ] );
        $certificationRuleViolation->setLine( (int)$fileElement[ 'line' ] );
        $certificationRuleViolation->setNamespace( (string)$fileElement[ 'namespace' ] );

        return $certificationRuleViolation;
    }

    /**
     * Get all violations of code metrics from the OXMD XML file.
     *
     * @return array returns all violations of code metrics determind by OXMD
     */
    public function getViolations( $xml )
    {
        $violations = array();

        foreach ( $xml->file as $oFile ) {
            $sName = (string)$oFile[ 'name' ];

            if ( isset( $oFile->violation ) ) {
                foreach ( $oFile->violation as $oViolation ) {
                    $outputViolation = new Violation();

                    $outputViolation->setFile( $sName )
                        ->setType( (string)$oViolation[ 'rule' ] )
                        ->addInformation( 'Begin', (int)$oViolation[ 'beginline' ] )
                        ->addInformation( 'End', (int)$oViolation[ 'endline' ] )
                        ->addInformation( 'Package', (string)$oViolation[ 'package' ] )
                        ->addInformation( 'Class', (string)$oViolation[ 'class' ] )
                        ->addInformation( 'Method', (string)$oViolation[ 'method' ] )
                        ->setMessage( trim( (string)$oViolation ) );

                    $violations[ ] = $outputViolation;
                }
            }
        }

        return $violations;
    }

}
