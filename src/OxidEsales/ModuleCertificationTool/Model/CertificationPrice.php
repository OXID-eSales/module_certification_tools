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

use OxidEsales\ModuleCertificationTool\Result\CertificationResult;
use OxidEsales\ModuleCertificationTool\View;

/**
 * Class CertificationPrice controller class to handle the output of the OXMD module
 */
class CertificationPrice
{

    private $result;

    public function __construct( CertificationResult $result )
    {
        $this->result = $result;
    }


    /**
     * Returns the HTML code for the output of the OXMD file.
     *
     * @return string HTML code for the output
     */
    public function getHtml()
    {

        $view = new View();
        $html = $view->setTemplate( 'certificationPrice' )
            ->assignVariable( 'oCertificationResult', $this->result )
            ->render();

        return $html;
    }

}
