<?php
/**
 * This file is part of the PHP Mess Detector OXID extension.
 *
 * PHP Version 5
 *
 * Copyright (c) 2014, Manuel Pichler <mapi@phpmd.org>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Manuel Pichler nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @author    Manuel Pichler <mapi@phpmd.org>
 * @copyright 2014 Manuel Pichler. All rights reserved.
 * @license   http://www.opensource.org/licenses/bsd-license.php BSD License
 * @version   @project.version@
 */

namespace PHPMD\OXMD\Renderer;

use PHPMD\AbstractRenderer;
use PHPMD\OXMD\Certification\CertificationCost;
use PHPMD\OXMD\Certification\ExtremeValue;
use PHPMD\OXMD\Certification\ExtremeValues;
use PHPMD\OXMD\Version;
use PHPMD\PHPMD;
use PHPMD\Report;

/**
 * This class will render a Java-PMD compatible xml-report.
 *
 * @author    Manuel Pichler <mapi@phpmd.org>
 * @copyright 2008-2014 Manuel Pichler. All rights reserved.
 * @license   http://www.opensource.org/licenses/bsd-license.php BSD License
 * @version   @project.version@
 */
class XmlRenderer extends AbstractRenderer
{
    /**
     * Temporary property that holds the name of the last rendered file, it is
     * used to detect the next processed file.
     *
     * @var string
     */
    private $fileName = null;

    /**
     * @var \PHPMD\OXMD\Certification\CertificationCost
     */
    private $certificationCost;

    /**
     * @var \PHPMD\OXMD\Certification\ExtremeValues
     */
    private $extremeValues;

    public function __construct()
    {
        $this->certificationCost = new CertificationCost();
    }

    /**
     * This method will be called on all renderers before the engine starts the
     * real report processing.
     *
     * @return void
     */
    public function start()
    {
        $this->getWriter()->write('<?xml version="1.0" encoding="UTF-8" ?>');
        $this->getWriter()->write(PHP_EOL);
    }

    /**
     * This method will be called when the engine has finished the source analysis
     * phase.
     *
     * @param \PHPMD\Report $report
     * @return void
     */
    public function renderReport(Report $report)
    {
        $this->extremeValues = ExtremeValues::createFromViolations($report->getRuleViolations());

        $writer = $this->getWriter();
        $writer->write('<pmd ');
        $writer->write('xmlns:oxid="http://wiki.oxidforge.org/Certification/Modules" ');
        $writer->write('oxid:version="' . Version::getOxmdVersion() . '" ');
        $writer->write('version="' . Version::getPhpmdVersion() . '" ');
        $writer->write('timestamp="' . date('c') . '">');
        $writer->write(PHP_EOL);

        foreach ($report->getRuleViolations() as $violation) {
            $fileName = $violation->getFileName();
            
            if ($this->fileName !== $fileName) {
                // Not first file
                if ($this->fileName !== null) {
                    $writer->write('  </file>' . PHP_EOL);
                }
                // Store current file name
                $this->fileName = $fileName;

                $writer->write('  <file name="' . $fileName . '">' . PHP_EOL);
            }

            $rule = $violation->getRule();

            $writer->write('    <violation');
            $writer->write(' beginline="' . $violation->getBeginLine() . '"');
            $writer->write(' endline="' . $violation->getEndLine() . '"');
            $writer->write(' rule="' . $rule->getName() . '"');
            $writer->write(' ruleset="' . $rule->getRuleSetName() . '"');
            
            $this->maybeAdd('package', $violation->getNamespaceName());
            $this->maybeAdd('externalInfoUrl', $rule->getExternalInfoUrl());
            $this->maybeAdd('function', $violation->getFunctionName());
            $this->maybeAdd('class', $violation->getClassName());
            $this->maybeAdd('method', $violation->getMethodName());
            //$this->_maybeAdd('variable', $violation->getVariableName());

            $writer->write(' priority="' . $rule->getPriority() . '"');
            $writer->write('>' . PHP_EOL);
            $writer->write('      ' . $violation->getDescription() . PHP_EOL);
            $writer->write('    </violation>' . PHP_EOL);
        }

        // Last file and at least one violation
        if ($this->fileName !== null) {
            $writer->write('  </file>' . PHP_EOL);
        }

        foreach ($report->getErrors() as $error) {
            $writer->write('  <error filename="');
            $writer->write($error->getFile());
            $writer->write('" msg="');
            $writer->write(htmlspecialchars($error->getMessage()));
            $writer->write('" />' . PHP_EOL);
        }



        if ($this->extremeValues->calculateFactor() > 1.0) {
            $writer->write(PHP_EOL);
            $writer->write('  <oxid:certification factor="');
            $writer->write($this->extremeValues->calculateFactor());
            $writer->write('" price="');
            $writer->write($this->certificationCost->calculate($this->extremeValues));
            $writer->write('">' . PHP_EOL);

            $this->renderExtremeValue('Code Coverage', $this->extremeValues->getCoverage());
            $this->renderExtremeValue('C.R.A.P Index', $this->extremeValues->getCrapIndex());
            $this->renderExtremeValue('NPath Complexity', $this->extremeValues->getNpath());
            $this->renderExtremeValue('Cyclomatic Complexity', $this->extremeValues->getCcn());

            $writer->write('  </oxid:certification>' . PHP_EOL);
        }

        $writer->write('</pmd>' . PHP_EOL);
    }

    private function renderExtremeValue($label, ExtremeValue $extremeValue)
    {
        $writer = $this->getWriter();

        $writer->write('    <oxid:rule');
        $this->maybeAdd('name', $label);
        $this->maybeAdd('threshold', $extremeValue->getThreshold());
        $this->maybeAdd('value', $extremeValue->getValue());
        $this->maybeAdd('factor', $extremeValue->getFactor());
        $this->maybeAdd('violated', $extremeValue->getFactor() > 1.0 ? 'true' : 'false');
        $writer->write('>' . PHP_EOL);

        foreach ($extremeValue->getViolations() as $violation) {
            $writer->write('      <oxid:file');
            $this->maybeAdd('path', $violation->getFileName());
            $this->maybeAdd('line', $violation->getBeginLine());
            $this->maybeAdd('namespace', $violation->getNamespaceName());
            $this->maybeAdd('class', $violation->getClassName());
            $this->maybeAdd('method', $violation->getMethodName());;
            $writer->write(' />' . PHP_EOL);
        }

        $writer->write('    </oxid:rule>' . PHP_EOL);
    }

    /**
     * This method will write a xml attribute named <b>$attr</b> to the output
     * when the given <b>$value</b> is not an empty string and is not <b>null</b>.
     *
     * @param string $attr  The xml attribute name.
     * @param string $value The attribute value.
     *
     * @return void
     */
    private function maybeAdd($attr, $value)
    {
        if ($value === null || trim($value) === '') {
            return;
        }
        $this->getWriter()->write(' ' . $attr . '="' . $value . '"');
    }
}
