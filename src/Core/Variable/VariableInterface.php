<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Core\Variable;

/**
 * An interface that should be implemented by all variables.
 */
interface VariableInterface
{
    /**
     * Gets the value of the variable.
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Sets the value for this variable.
     *
     * @param mixed $value The value to set.
     */
    public function setValue($value);
}
