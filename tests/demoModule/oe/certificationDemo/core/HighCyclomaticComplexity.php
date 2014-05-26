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

/**
 * Class HighCyclomaticComplexity: Class for generating a high cyclomatic complexity
 */
class HighCyclomaticComplexity
{
    /**
     * Method with a very high cyclomatic complexity.
     *
     * @param int $value Value for choosing switch tree
     *
     * @return int Calculated value
     */
    public function hasHighComplexity( $value )
    {
        switch ( $value ) {
            case 1:
                $return = ( 0 == $value % 2 ) ? $value : $value + 1;
                break;
            case 2:
                $return = ( 0 == $value % 2 ) ? $value : $value + 1;
                break;
            case 3:
                $return = ( 0 == $value % 2 ) ? $value : $value + 1;
                break;
            case 4:
                $return = ( 0 == $value % 2 ) ? $value : $value + 1;
                break;
            case 5:
                $return = ( 0 == $value % 2 ) ? $value : $value + 1;
                break;
            case 6:
                $return = ( 0 == $value % 2 ) ? $value : $value + 1;
                break;
            case 7:
                $return = ( 0 == $value % 2 ) ? $value : $value + 1;
                break;
            case 8:
                $return = ( 0 == $value % 2 ) ? $value : $value + 1;
                break;
            case 9:
                $return = ( 0 == $value % 2 ) ? $value : $value + 1;
                break;
            default:
                $return = $value;

        }

        return $return;
    }
}
