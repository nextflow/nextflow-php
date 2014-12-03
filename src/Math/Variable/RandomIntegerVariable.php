<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Math\Variable;

use NextFlow\Php\Variable\IntegerVariable;

/**
 * A variable that holds a random integer variable.
 */
class RandomIntegerVariable extends IntegerVariable
{
    /**
     * Initializes a new instance of this class.
     *
     * @param int $min The minimum value.
     * @param int $max The maximum value.
     */
    public function __construct($min = 0, $max = PHP_INT_MAX)
    {
        $value = rand($min, $max);

        parent::__construct($value);
    }
}
