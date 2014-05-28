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

use OxidEsales\ModuleCertificationTool\Model\CertificationPrice;
use OxidEsales\ModuleCertificationTool\Model\FileViolations;
use OxidEsales\ModuleCertificationTool\Model\GenericChecks;
use OxidEsales\ModuleCertificationTool\Parser\MdXmlParser;
use OxidEsales\ModuleCertificationTool\Parser\GenericViolationXmlParser;
use OxidEsales\ModuleCertificationTool\View;

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
        $mdXmlParser         = new MdXmlParser();
        $mdXmlParser->cleanUpXmlFile( $this->configuration->sMdXmlFile );
        $certificationResult = $mdXmlParser->parse( $mdXmlParser->getXmlObjectFromFile( $this->configuration->sMdXmlFile ) );

        $violationXmlParser  = new GenericViolationXmlParser();
        $directoryViolations = $violationXmlParser->parse( $violationXmlParser->getXmlObjectFromFile( $this->configuration->sDirectoryXmlFile ) );
        $globalViolations    = $violationXmlParser->parse( $violationXmlParser->getXmlObjectFromFile( $this->configuration->sGlobalsXmlFile ) );
        $prefixViolations    = $violationXmlParser->parse( $violationXmlParser->getXmlObjectFromFile( $this->configuration->sPrefixXmlFile ) );

        $view = new View();
        $view->setTemplate( 'index' );

        $fileViolationHtmls = array( 'Error while processing clover xml: file not found' );
        $sMdHtml            = "";
        if ( !( empty( $certificationResult ) ) ) {
            $oCertificationPrice = new CertificationPrice( $certificationResult );
            $sMdHtml     = $oCertificationPrice->getHtml();

            foreach ( $certificationResult->getViolations() as $ruleName => $fileViolations ) {
                $fileViolations = new FileViolations( $fileViolations );
                $fileViolations->setHeading( $ruleName );
                $fileViolationHtmls[ ] = $fileViolations->getHtml();
            }
        }
        $view->assignVariable( 'sCertificationResult', $sMdHtml );
        $view->assignVariable( 'aFileViolations', $fileViolationHtmls );

        $genericChecks = new GenericChecks( $directoryViolations );
        $directoriesHtml         = $genericChecks->setHeading( 'Directories' )->getHtml();

        $genericChecks = new GenericChecks( $globalViolations );
        $globalsHtml             = $genericChecks->setHeading( 'Globals' )->getHtml();

        $genericChecks = new GenericChecks( $prefixViolations );
        $prefixedHtml            = $genericChecks->setHeading( 'Prefixes' )->getHtml();

        $view->assignVariable(
             'aGenericChecks',
             array( $directoriesHtml, $globalsHtml, $prefixedHtml )
        );

        $html = $view->render();

        file_put_contents( $this->configuration->sOutputFile, $html );

        return $this;
    }
}
