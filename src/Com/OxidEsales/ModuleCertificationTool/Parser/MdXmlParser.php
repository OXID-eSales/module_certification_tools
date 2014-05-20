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

namespace Com\OxidEsales\ModuleCertificationTool\Parser;

use Com\OxidEsales\ModuleCertificationTool\Model\CertificationResult;
use Com\OxidEsales\ModuleCertificationTool\Model\CertificationRule;
use Com\OxidEsales\ModuleCertificationTool\Model\MdResult;
use Com\OxidEsales\ModuleCertificationTool\Violation;

/**
 * Class MdXmlParser class for the application
 */
class MdXmlParser
{

    public function parse($sXmlFileName)
    {
        // workaround for simpleXML namespace issue
        $sData = file_get_contents($sXmlFileName);
        $sData = str_replace('<oxid:', '<', $sData);
        $sData = str_replace('</oxid:', '</', $sData);
        file_put_contents($sXmlFileName, $sData);

        $oXml = simplexml_load_file($sXmlFileName);

        return $this->parseXml($oXml);
    }

    /**
     * @param $oXml
     * @return CertificationResult
     */
    public function parseXml($oXml)
    {
       $oCertificationResult = new CertificationResult();

        $oCertification = $oXml->certification;
        $oCertificationResult->setPrice((string )$oCertification['price']);
        $oCertificationResult->setFactor((float)$oCertification['factor']);

        $aCertificationRules = array();

        if (isset($oCertification->rule)) {
            foreach ($oCertification->rule as $oRuleElement) {
                $oCertificationRule = $this->parseCertificationRule($oRuleElement);
                $aCertificationRules[$oCertificationRule->getName()] = $oCertificationRule;
            }
        }

        $oCertificationResult->setCertificationRules($aCertificationRules);

        return $oCertificationResult;
    }

    /**
     * @param $oRuleElement
     * @return CertificationRule
     */
    public function parseCertificationRule($oRuleElement) {

        $oCertificationRule = new CertificationRule();

        $oCertificationRule->setName((string)$oRuleElement['name']);
        $oCertificationRule->setViolated((bool)$oRuleElement['violated']);
        $oCertificationRule->setValue((int)$oRuleElement['value']);
        $oCertificationRule->setFactor((float)$oRuleElement['factor']);

        return $oCertificationRule;
    }

    /**
     * Get all violations of code metrics from the OXMD XML file.
     *
     * @return array returns all violations of code metrics determind by OXMD
     */
    public function getViolations($oXml)
    {
        $aViolations = array();

        foreach ($oXml->file as $oFile) {
            $sName = (string)$oFile['name'];

            if (isset($oFile->violation)) {
                foreach ($oFile->violation as $oViolation) {
                    $oOutputViolation = new Violation();

                    $oOutputViolation->setFile($sName)
                        ->setType((string)$oViolation['rule'])
                        ->addInformation('Begin', (int)$oViolation['beginline'])
                        ->addInformation('End', (int)$oViolation['endline'])
                        ->addInformation('Package', (string)$oViolation['package'])
                        ->addInformation('Class', (string)$oViolation['class'])
                        ->addInformation('Method', (string)$oViolation['method'])
                        ->setMessage(trim((string)$oViolation));

                    $aViolations[] = $oOutputViolation;
                }
            }
        }

        return $aViolations;
    }

    /**
     * Returns a summary object with the important results of OXMD.
     *
     * @return object summary information of the OXMD XML file
     */
    public function getOverview($oXml)
    {
        $aViolations = array();
        $oOverviewData = (object)array('sPrice' => null, 'sFactor' => null, 'aViolations' => array());

        $oCertification = $oXml->certification;
        $oOverviewData->sPrice = (string )$oCertification['price'];
        $oOverviewData->sFactor = (string)$oCertification['factor'];

        if (isset($oCertification->rule)) {
            foreach ($oCertification->rule as $oRule) {
                $oViolation = new Violation();
                $oViolation->setViolated(((string)$oRule['violated']) == 'true');
                $oViolation->setType((string)$oRule['name']);
                $oViolation->addInformation('Value', (string)$oRule['value']);
                $oViolation->addInformation('Factor', (string)$oRule['factor']);

                $aViolations[$oViolation->getType()] = $oViolation;

                $aFiles = array();
                foreach ($oRule->file as $oFile) {
                    $aFiles[] = (string)$oFile['class'] . '::' . (string)$oFile['method'] . ' (' . (string)$oFile['path'] . ')';
                }
                $oViolation->addInformation('Files', $aFiles);

                $oOverviewData->aViolations[] = $oViolation;
            }
        }

        var_dump($aViolations);

        return $oOverviewData;
    }

}
