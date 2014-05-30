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

/**
 * Class View class for handling the template files
 */
class View
{

    /**
     * Contain the nme of the template corresponding to the view object.
     *
     * @var string
     */
    protected $template = '';

    /**
     * Contains all assigned variables.
     *
     * @var array
     */
    protected $variables = array();

    /**
     * The file name extension of the template files.
     *
     * @var string
     */
    protected $templateExtension = 'phtml';

    /**
     * The path of the directory containing the template files.
     *
     * @var string
     */
    protected $templateDirectory = null;


    public function  __construct()
    {
        $this->templateDirectory = realpath(__DIR__ .
                                            DIRECTORY_SEPARATOR . '..' .
                                            DIRECTORY_SEPARATOR . '..' .
                                            DIRECTORY_SEPARATOR . '..' .
                                            DIRECTORY_SEPARATOR . 'resource' .
                                            DIRECTORY_SEPARATOR . 'tpl'

        ) . DIRECTORY_SEPARATOR;
    }

    /**
     * Set the template for this view object.
     *
     * @param string $template name of the template
     *
     * @return $this the view object itself
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Assigns a variable to the template.
     *
     * @param string $variableName name of the assigned variable
     * @param mixed $variableContent data containing the assigned variable
     *
     * @return $this the view object itself
     */
    public function assignVariable($variableName, $variableContent)
    {
        $this->variables[$variableName] = $variableContent;

        return $this;
    }

    /**
     * Reeturns the HTML code after rendering.
     *
     * @return string the rendered HTML code
     */
    public function render()
    {
        // Data is used in template file, so do not remove here
        $data = (object)$this->variables;

        $filePath = $this->templateDirectory . $this->template . '.' . $this->templateExtension;
        if ( is_file( $filePath ) && is_readable( $filePath ) ) {
            ob_start();
            include $filePath;
            $output = ob_get_contents();
            ob_end_clean();
        } else {
            throw new \Exception( 'template ' . $this->template . ' not found' );
        }

        return $output;
    }
}
