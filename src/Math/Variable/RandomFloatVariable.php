<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Math\Variable;

use NextFlow\Php\Variable\FloatVariable;

/**
 * A variable that holds a random float variable.
 */
class RandomFloatVariable extends FloatVariable
{
    /**
     * Initializes a new instance of this class.
     *
     * @param float $min The minimum value.
     * @param float $max The maximum value.
     * @param float $decimals The amount of decimals to round to.
     */
    public function __construct($min = 0.0, $max = 1.0, $decimals = 0)
    {
        $value = ($min + lcg_value() * (abs($max - $min)));
        if ($decimals != 0) {
            $value = round($value, $decimals);
        }

        parent::__construct($value);
    }
}
