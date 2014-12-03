<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Math\Variable;

use NextFlow\Math\Variable\RandomFloatVariable;
use PHPUnit_Framework_TestCase;

class RandomFloatVariableTest extends PHPUnit_Framework_TestCase
{
    public function testMinimumValue()
    {
        $variable = new RandomFloatVariable(10, 20);

        $this->assertGreaterThanOrEqual(10, $variable->getValue());
    }

    public function testMaximumValue()
    {
        $variable = new RandomFloatVariable(10, 20);

        $this->assertLessThanOrEqual(20, $variable->getValue());
    }

    public function testDecimals()
    {
        $variable = new RandomFloatVariable(10, 20, 1);

        $this->assertEquals(4, strlen((string)$variable->getValue()));
    }
}
