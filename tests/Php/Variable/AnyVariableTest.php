<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Php\Variable;

use NextFlow\Php\Variable\AnyVariable;
use PHPUnit_Framework_TestCase;

class AnyVariableTest extends PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $variable = new AnyVariable();
        $variable->execute();
    }
}
