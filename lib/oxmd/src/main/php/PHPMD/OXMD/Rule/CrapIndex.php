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
 * @since      1.2.0
 */

namespace PHPMD\OXMD\Rule;

use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Rule\MethodAware;

/**
 * This rule checks the C.R.A.P. Index metric of functions and methods. It takes
 * the metric from a given node and compares the value with the configured
 * maximum threshold.
 *
 * @author    Manuel Pichler <mapi@phpmd.org>
 * @copyright 2014 Manuel Pichler. All rights reserved.
 * @license   http://www.opensource.org/licenses/bsd-license.php BSD License
 * @version   @project.version@
 */
class CrapIndex extends AbstractRule implements MethodAware
{
    /**
     * This method tests the C.R.A.P. Index of the given node against the
     * configured maximum threshold.
     *
     * @param \PHPMD\AbstractNode $node
     * @return void
     */
    public function apply(AbstractNode $node)
    {
        if ($node->getMetric('crap') <= $this->getIntProperty('maximum')) {
            return;
        }

        $this->addViolation(
            $node,
            array(
                $node->getParentName(),
                $node->getName(),
                round($node->getMetric('crap'), 2),
                $this->getIntProperty('maximum')
            ),
            $node->getMetric('crap')
        );

        /* @deprecated average calculation
        if ($node instanceof ClassNode) {
            $this->classes[$node->getName()]  = array_flip($node->getMethodNames());

            $this->crap  = 0;
            $this->count = 0;

            return;
        } else if (!($node->getParentType() instanceof InterfaceNode)) {
            if (false === $node->isAbstract() && is_numeric($node->getMetric('crap'))) {
                $this->crap += $node->getMetric('crap');
                ++$this->count;
            }
            unset($this->classes[$node->getParentName()][$node->getName()]);
        }

        if (0 === $this->count || false === isset($this->classes[$node->getParentName()]) || 0 < count($this->classes[$node->getParentName()])) {
            return;
        }

        $crap = $this->crap / $this->count;

        if ($crap > $this->getIntProperty('maximum')) {
            $this->addViolation(
                $node->getParentType(),
                array(
                    $node->getParentName(),
                    round($crap, 2),
                    $this->getIntProperty('maximum')
                ),
                $crap
            );
        }
        */
    }
}
