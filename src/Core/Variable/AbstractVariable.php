<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Core\Variable;

use NextFlow\Core\Node\AbstractNode;

/**
 * The base final class for all variables.
 */
abstract class AbstractVariable extends AbstractNode implements VariableInterface
{
    /**
     * Initializes a new instance of this class.
     *
     * @param mixed $value The value to set.
     */
    public function __construct($value = null)
    {
        parent::__construct();

        if ($value !== null) {
            $this->setValue($value);
        }
    }

    /**
     * Executes the node's logic.
     */
    public function execute()
    {
        // There is nothing to execute but we keep it here so that all variables don't have to
        // implement this method.
    }
}
