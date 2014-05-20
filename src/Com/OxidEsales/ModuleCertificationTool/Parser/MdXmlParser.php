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

    public function parseXml($oXml)
    {
        $oMdResult = new MdResult();

        $oMdResult->setViolations($this->getViolations($oXml));
        $oMdResult->setOverview($this->getOverview($oXml));

        return $oMdResult;
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
        $oOverviewData = (object)array('sPrice' => null, 'sFactor' => null, 'aViolations' => array());

        $oCertification = $oXml->certification;
        $oOverviewData->sPrice = (string )$oCertification['price'];
        $oOverviewData->sFactor = (string)$oCertification['factor'];

        if (isset($oCertification->rule)) {
            foreach ($oCertification->rule as $oRule) {
                if (((string)$oRule['violated']) == 'true') {
                    $oViolation = new Violation();
                    $oViolation->setType((string)$oRule['name']);
                    $oViolation->addInformation('Value', (string)$oRule['value']);
                    $oViolation->addInformation('Factor', (string)$oRule['factor']);

                    $aFiles = array();
                    foreach ($oRule->file as $oFile) {
                        $aFiles[] = (string)$oFile['class'] . '::' . (string)$oFile['method'] . ' (' . (string)$oFile['path'] . ')';
                    }
                    $oViolation->addInformation('Files', $aFiles);

                    $oOverviewData->aViolations[] = $oViolation;
                }
            }
        }

        return $oOverviewData;
    }

}
