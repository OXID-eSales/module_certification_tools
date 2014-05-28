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
 * Class Violation class for handling XML output file of generic check modules
 */
class Violation
{


    /**
     * Contains the Vialations should be shown in output.
     *
     * @var array
     */
    private $violations;

    /**
     * Contains the Heading should be shown in output.
     *
     * @var string
     */
    private $heading = '';

    /**
     * Contains the template for output.
     *
     * @var string
     */
    private $template = '';

    public function __construct(array $violations, $template)
    {
        $this->violations = $violations;
        $this->template = $template;
    }


    /**
     * @return array
     */
    public function getViolations()
    {
        return $this->violations;
    }

    /**
     * @return string
     */
    public function getHeading()
    {
        return $this->heading;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Sets the heading that should be shown in output.
     *
     * @param string $heading the heading for this XML file.
     *
     * @return $this the controller itself
     */
    public function setHeading($heading)
    {
        $this->heading = $heading;

        return $this;
    }

    /**
     * Returns the rendered HTML code with the information from the checker module.
     *
     * @return string the HTML output corresponding to the XML file output of the module
     */
    public function getHtml()
    {
        $view = new View();
        $html = "";
        if (count($this->getViolations) > 0) {
            $html = $view->setTemplate($this->getTemplate())
                         ->assignVariable( 'aViolations', $this->getViolations() )
                         ->assignVariable( 'sHeading', $this->getHeading() )
                ->render();
        }

        return $html;
    }

}
