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

namespace OxidEsales\ModuleCertificationTool\Parser;

use OxidEsales\ModuleCertificationTool\Result\GenericViolation;

/**
 * Class ViolationXmlParser: Class for parsing the generic XML files into violation objects.
 *
 * @package OxidEsales\ModuleCertificationTool\Parser
 */
class GenericViolationXmlParser
{

    /**
     * Loads a XML file into am SimpleXML object.
     *
     * @param string $xmlFileName The name of the XML file.
     *
     * @return \SimpleXMLElement The SimpleXML object representing the XML file
     */
    public function getXmlObjectFromFile($xmlFileName)
    {
        $xml = simplexml_load_file($xmlFileName);

        return $xml;
    }

    /**
     * Returns the violations from the XML output file.
     *
     * @param  \SimpleXMLElement $xml Simple XML Element from the XML output file.
     *
     * @return array Violations determined by a generic module
     */
    public function parse($xml)
    {
        $violations = array();
        if (isset($xml->failures->failure)) {
            foreach ($xml->failures->failure as $failureElement) {
                $violation = new GenericViolation();

                $violation->setMessage(trim((string) $failureElement));

                $violations[] = $violation;
            }
        }

        return $violations;
    }
}
