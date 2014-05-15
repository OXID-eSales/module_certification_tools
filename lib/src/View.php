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

class View {

    /**
     * @var string
     */
    protected $_sTemplate = '';

    /**
     * @var array
     */
    protected $_aVariables = array();

    /**
     * @var string
     */
    protected $_sTemplateExtension = 'phtml';

    /**
     * @var string
     */
    protected $_sTemplateDirectory = '../tpl/';

    /**
     * @param string $sTemplate
     *
     * @return $this
     */
    public function setTemplate( $sTemplate ) {
        $this->_sTemplate = $sTemplate;

        return $this;
    }

    /**
     * @param string $sVariableName
     * @param mixed $xVariableContent
     *
     * @return $this
     */
    public function assignVariable( $sVariableName, $xVariableContent ) {
        $this->_aVariables[ $sVariableName ] = $xVariableContent;

        return $this;
    }

    /**
     * @return string
     */
    public function render() {
        $data = (object) $this->_aVariables;
        ob_start();
        $sFilepath = $this->_sTemplateDirectory . $this->_sTemplate . '.' . $this->_sTemplateExtension;
        include $sFilepath;
        $sOutput = ob_get_contents();
        ob_end_clean();

        return $sOutput;
    }




}
