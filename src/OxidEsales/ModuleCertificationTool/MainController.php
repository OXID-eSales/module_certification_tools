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

namespace OxidEsales\ModuleCertificationTool;

use OxidEsales\ModuleCertificationTool\Model\ModuleCertificationResult;
use OxidEsales\ModuleCertificationTool\Parser\MdXmlParser;
use OxidEsales\ModuleCertificationTool\Parser\ViolationXmlParser;

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
    protected $configuration;

    /**
     * Fills the configuration object of the class with given values.
     *
     * @param array $configuration array with all the configuration values
     *
     * @return $this the controller itself
     */
    public function setConfiguration( $configuration )
    {
        $this->configuration = (object)$configuration;

        return $this;
    }

    /**
     * Main Action for running the application.
     *
     * @return $this the controller itself
     */
    public function indexAction()
    {

        $mdXmlParser = new MdXmlParser();
        $certificationResult = $mdXmlParser->parse( $this->configuration->sMdXmlFile );

        $violationXmlParser = new ViolationXmlParser();
        $directoryViolations = $violationXmlParser->parse( $this->configuration->sDirectoryXmlFile );
        $globalViolations = $violationXmlParser->parse( $this->configuration->sGlobalsXmlFile );
        $prefixViolations = $violationXmlParser->parse( $this->configuration->sPrefixXmlFile );

        $view = new View();
        $view->setTemplate( 'index' );

        $oController = new CertificationPriceController( $certificationResult );
        $sMdHtml = $oController->getHtml();

        $view->assignVariable('sCertificationResult', $sMdHtml);

//        $aCertViolationHtmls = array();
//        foreach ($oCertificationResult->getCertificationRules() as $ruleName => $certificationRule) {
//            /* @var \Com\OxidEsales\ModuleCertificationTool\Model\CertificationRule $certificationRule */
//            if ($certificationRule->getViolated()) {
//                $aViolations = $certificationRule->getViolations();
//                $oCertViolationsController = new CertificationRuleViolationsController($aViolations);
//                $oCertViolationsController->setHeading($ruleName);
//                $aCertViolationHtmls[] = $oCertViolationsController->getHtml();
//            }
//        }
//
//        $oView->assignVariable('aCertViolations', $aCertViolationHtmls);

        $fileViolationHtmls = array();
        foreach ($certificationResult->getViolations() as $ruleName => $fileViolations) {
            $fileViolationsController = new FileViolationsController($fileViolations);
            $fileViolationsController->setHeading($ruleName);
            $fileViolationHtmls[] = $fileViolationsController->getHtml();
        }

        $view->assignVariable('aFileViolations', $fileViolationHtmls);

        $genericChecksController = new GenericChecksController( $directoryViolations );
        $directoriesHtml = $genericChecksController->setHeading( 'Directories' )->getHtml();

        $genericChecksController = new GenericChecksController( $globalViolations );
        $globalsHtml = $genericChecksController->setHeading( 'Globals' )->getHtml();

        $genericChecksController = new GenericChecksController( $prefixViolations );
        $prefixedHtml = $genericChecksController->setHeading( 'Prefixes' )->getHtml();

        $view->assignVariable(
            'aGenericChecks',
            array( $directoriesHtml, $globalsHtml, $prefixedHtml )
        );

        $html = $view->render();

        file_put_contents( $this->configuration->sOutputFile, $html );

        return $this;
    }

}
