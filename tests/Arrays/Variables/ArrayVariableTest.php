<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Arrays\Variable;

use NextFlow\Arrays\Variables\ArrayVariable;

class ArrayVariableTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $variable = new ArrayVariable();
        $variable->execute();
    }
}
