<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Math\Action;

/**
 * Multiplies the left value with the right value.
 */
class MultiplyAction extends AbstractAction
{
    /**
     * The method that calculates the value.
     *
     * @param int $lft The left value.
     * @param int $rgt The right value.
     * @return Returns the calculated value.
     */
    protected function calculateValue($lft, $rgt)
    {
        return $lft * $rgt;
    }
}
