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

namespace Com\OxidEsales\ModuleCertificationTool\Model;

/**
 * Class MdResult class for the application
 */
class MdResult
{

    private $aViolations;
    private $aOverview;


    public function getOverview()
    {
        return $this->aOverview;
    }

    public function setOverview($aOverview)
    {
        $this->aOverview = $aOverview;
    }


    public function getViolations()
    {
        return $this->aViolations;
    }

    public function setViolations($aViolations)
    {
        $this->aViolations = $aViolations;
    }
}
