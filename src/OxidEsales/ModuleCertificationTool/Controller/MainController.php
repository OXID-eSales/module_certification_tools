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
use OxidEsales\ModuleCertificationTool\Model\Violation;
use OxidEsales\ModuleCertificationTool\Parser\MdXmlParser;
use OxidEsales\ModuleCertificationTool\Parser\GenericViolationXmlParser;
use OxidEsales\ModuleCertificationTool\Result\CertificationResult;
use OxidEsales\ModuleCertificationTool\View;

/**
 * Class MainController: The main controller class for the application.
 *
 * @package OxidEsales\ModuleCertificationTool\Controller
 */
class MainController
{

    /**
     * @var object Contains als the configuration values for the application.
     */
    protected $configuration;

    /**
     * Fills the configuration object of the class with given values.
     *
     * @param array $configuration Array with all the configuration values
     *
     * @return $this The controller itself
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = (object) $configuration;

        return $this;
    }

    /**
     * Main Action for running the application.
     *
     * @return $this The controller itself
     * @throws \Exception
     */
    public function indexAction()
    {
        $view = new View();
        $view->setTemplate('index');

        $fileViolationHtmls = array('Error while processing clover xml: file not found');
        $mdHtml = "";

        $this->testModulePath($this->configuration->modulePath);

        $certificationResult = $this->parseMd();
        if (!(empty($certificationResult))) {
            $mdHtml = $this->getPrice($certificationResult);
            $fileViolationHtmls = $this->getFileViolations($certificationResult);
        }

        $view->assignVariable('certificationResult', $mdHtml);
        $view->assignVariable('fileViolations', $fileViolationHtmls);
        $genericHtml = $this->parseGeneric();
        $view->assignVariable('genericChecks', $genericHtml);

        $html = $view->render();
        $this->writeOutputFile($this->configuration->outputFile, $html);

        return $this;
    }

    /**
     * Writes the output file.
     *
     * @param string $outputFile  Path to the output file
     * @param string $html        Content to write
     *
     * @throws \Exception
     */
    private function writeOutputFile($outputFile, $html)
    {
        if (false === @file_put_contents($outputFile, $html)) {
            throw new \Exception('error while writing ' . $outputFile);
        }
    }

    /**
     * Tests if the path to module is a valid directory.
     *
     * @param string $modulePath The path to the module dir
     *
     * @throws \Exception
     */
    private function testModulePath($modulePath)
    {
        if (!is_dir($modulePath) || !is_readable($modulePath)) {
            throw new \Exception('no module found in ' . $modulePath);
        }
    }

    /**
     * Gets the price form a certification result object.
     *
     * @param CertificationResult $certificationResult The certification result object
     *
     * @return string The price as string
     */
    private function getPrice($certificationResult)
    {
        $certificationPrice = new CertificationPrice($certificationResult);

        return $certificationPrice->getHtml();
    }

    /**
     * Parses the OXMD XML file into a certification result object.
     *
     * @return \OxidEsales\ModuleCertificationTool\Result\CertificationResult The certification result object
     */
    private function parseMd()
    {
        $mdXmlParser = new MdXmlParser();
        $mdXmlParser->cleanUpXmlFile($this->configuration->mdXmlFile);
        $certificationResult = $mdXmlParser->parse($mdXmlParser->getXmlObjectFromFile($this->configuration->mdXmlFile));

        return $certificationResult;
    }

    /**
     * Parses the generic XML files into an array of violation objects.
     *
     * @return array Array of violation objects
     */
    private function parseGeneric()
    {
        $genericHtml = array();
        $violationXmlParser = new GenericViolationXmlParser();
        foreach ($this->configuration->additionalTests as $header => $file) {
            $violation = $violationXmlParser->parse($violationXmlParser->getXmlObjectFromFile($file));
            $genericCheck = new Violation($violation, 'genericViolationList');
            $genericHtml[] = $genericCheck->setHeading($header)->getHtml();
        }

        return $genericHtml;
    }

    /**
     * Parses the file violations from the OXMD file into an array of violation objects.
     *
     * @param CertificationResult $certificationResult The data object of the OXMD file
     *
     * @return array The file violations
     */
    private function getFileViolations($certificationResult)
    {
        $fileViolationHtmls = array();
        foreach ($certificationResult->getViolations() as $ruleName => $fileViolations) {
            $fileViolations = new Violation($fileViolations, 'fileViolationTable');
            $fileViolations->setHeading($ruleName);
            $fileViolationHtmls[] = $fileViolations->getHtml();
        }

        return $fileViolationHtmls;
    }
}
