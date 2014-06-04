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

namespace OxidEsales\ModuleCertificationTool\Model;

use OxidEsales\ModuleCertificationTool\View;

/**
 * Class Violation: Class for handling XML output file of generic check modules.
 *
 * @package OxidEsales\ModuleCertificationTool\Model
 */
class Violation
{
    /**
     * @var array Contains the Vialations should be shown in output.
     */
    private $violations;

    /**
     * @var string Contains the Heading should be shown in output.
     */
    private $heading = '';

    /**
     * @var string Contains the template for output.
     */
    private $template = '';

    /**
     * The constructor of the class.
     *
     * @param array $violations Violation array for the model
     * @param string $template Corresponding HTML template
     */
    public function __construct(array $violations, $template)
    {
        $this->violations = $violations;
        $this->template = $template;
    }

    /**
     * Gets the injected violations.
     *
     * @return array The injected violations
     */
    public function getViolations()
    {
        return $this->violations;
    }

    /**
     * Gets the heading that should be shown in output.
     *
     * @return string The heading for this XML file
     */
    public function getHeading()
    {
        return $this->heading;
    }

    /**
     * Gets the corresponding template for the XML file.
     *
     * @return string The name of the corresponding template
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Sets the heading that should be shown in output.
     *
     * @param string $heading The heading for this XML file
     *
     * @return $this The controller itself
     */
    public function setHeading($heading)
    {
        $this->heading = $heading;

        return $this;
    }

    /**
     * Returns the rendered HTML code with the information from the checker module.
     *
     * @return string The HTML output corresponding to the XML file output of the module
     */
    public function getHtml()
    {
        $view = new View();
        $html = "";
        if (count($this->getViolations()) > 0) {
            $html = $view->setTemplate($this->getTemplate())
                         ->assignVariable( 'violations', $this->getViolations() )
                         ->assignVariable( 'heading', $this->getHeading() )
                         ->render();
        }

        return $html;
    }

}
