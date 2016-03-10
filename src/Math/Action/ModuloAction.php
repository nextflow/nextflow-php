<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Math\Action;

/**
 * Calucaltes the modulo of the two values.
 */
final class ModuloAction extends AbstractAction
{
    /**
     * The method that calculates the value.
     *
     * @param double|float|int $lft The left value.
     * @param double|float|int $rgt The right value.
     * @return double|float|int Returns the calculated value.
     */
    protected function calculateValue($lft, $rgt)
    {
        return $lft % $rgt;
    }
}
