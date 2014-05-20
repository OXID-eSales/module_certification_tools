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

namespace Com\OxidEsales\ModuleCertificationTool;

use Com\OxidEsales\ModuleCertificationTool\Model\ModuleCertificationResult;
use Com\OxidEsales\ModuleCertificationTool\Parser\MdXmlParser;
use Com\OxidEsales\ModuleCertificationTool\Parser\ViolationXmlParser;

/**
 * Class MainController main controller class for the application
 */
class MainController
{

    /**
     * Contains als the configuration values for the application.
     *
     * @var object
     */
    protected $_oConfiguration;

    /**
     * Fills the configuration object of the class with given values.
     *
     * @param array $aConfiguration array with all the configuration values
     *
     * @return $this the controller itself
     */
    public function setConfiguration( $aConfiguration )
    {
        $this->_oConfiguration = (object)$aConfiguration;

        return $this;
    }

    /**
     * Main Action for running the application.
     *
     * @return $this the controller itself
     */
    public function indexAction()
    {

        $oMdXmlParser = new MdXmlParser();
        $oCertificationResult = $oMdXmlParser->parse( $this->_oConfiguration->sMdXmlFile );

        $oViolationXmlParser = new ViolationXmlParser();
        $aDirectoryViolations = $oViolationXmlParser->parse( $this->_oConfiguration->sDirectoryXmlFile );
        $aGlobalViolations = $oViolationXmlParser->parse( $this->_oConfiguration->sGlobalsXmlFile );
        $aPrefixViolations = $oViolationXmlParser->parse( $this->_oConfiguration->sPrefixXmlFile );

        $oView = new View();
        $oView->setTemplate( 'index' );

        $oController = new CertificationPriceController( $oCertificationResult );
        $sMdHtml = $oController->getHtml();

        $oView->assignVariable('sCertificationResult', $sMdHtml);

        $aCertViolationHtmls = array();
        foreach ($oCertificationResult->getCertificationRules() as $ruleName => $certificationRule) {
            /* @var \Com\OxidEsales\ModuleCertificationTool\Model\CertificationRule $certificationRule */
            if ($certificationRule->getViolated()) {
                $aViolations = $certificationRule->getViolations();
                $oCertViolationsController = new CertificationRuleViolationsController($aViolations);
                $oCertViolationsController->setHeading($ruleName);
                $aCertViolationHtmls[] = $oCertViolationsController->getHtml();
            }
        }

        $oView->assignVariable('aCertViolations', $aCertViolationHtmls);

        $oXmlController = new GenericChecksController( $aDirectoryViolations );
        $sDirectoriesHtml = $oXmlController->setHeading( 'Directories' )->getHtml();

        $oXmlController = new GenericChecksController( $aGlobalViolations );
        $sGlobalsHtml = $oXmlController->setHeading( 'Globals' )->getHtml();

        $oXmlController = new GenericChecksController( $aPrefixViolations );
        $sPrefixesHtml = $oXmlController->setHeading( 'Prefixes' )->getHtml();

        $oView->assignVariable(
            'aGenericChecks',
            array( $sDirectoriesHtml, $sGlobalsHtml, $sPrefixesHtml )
        );

        $sHtml = $oView->render();

        file_put_contents( $this->_oConfiguration->sOutputFile, $sHtml );

        return $this;
    }

}
