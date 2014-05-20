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

/**
 * Class View class for handling the template files
 */
class View {

    /**
     * Contain the nme of the template corresponding to the view object.
     *
     * @var string
     */
    protected $_sTemplate = '';

    /**
     * Contains all assigned variables.
     *
     * @var array
     */
    protected $_aVariables = array();

    /**
     * The file name extension of the template files.
     *
     * @var string
     */
    protected $_sTemplateExtension = 'phtml';

    /**
     * The path of the directory containing the template files.
     *
     * @var string
     */
    protected $_sTemplateDirectory = null;

    public function  __construct()
    {
        $this->_sTemplateDirectory = realpath( __DIR__ . '/../../../../resource/tpl/');
    }

    /**
     * Set the template for this view object.
     *
     * @param string $sTemplate name of the template
     *
     * @return $this the view object itself
     */
    public function setTemplate( $sTemplate ) {
        $this->_sTemplate = $sTemplate;

        return $this;
    }

    /**
     * Assigns a variable to the template.
     *
     * @param string $sVariableName name of the assigned variable
     * @param mixed $xVariableContent data containing the assigned variable
     *
     * @return $this the view object itself
     */
    public function assignVariable( $sVariableName, $xVariableContent ) {
        $this->_aVariables[ $sVariableName ] = $xVariableContent;

        return $this;
    }

    /**
     * Reeturns the HTML code after rendering.
     *
     * @return string the rendered HTML code
     */
    public function render() {
        $data = (object) $this->_aVariables;
        ob_start();
        $sFilepath = $this->_sTemplateDirectory . '/' . $this->_sTemplate . '.' . $this->_sTemplateExtension;
        include $sFilepath;
        $sOutput = ob_get_contents();
        ob_end_clean();

        return $sOutput;
    }
}
