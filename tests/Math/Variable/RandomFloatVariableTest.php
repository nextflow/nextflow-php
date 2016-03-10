<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Math\Variable;

use NextFlow\Math\Variable\RandomFloatVariable;
use PHPUnit_Framework_TestCase;

class RandomFloatVariableTest extends PHPUnit_Framework_TestCase
{
    public function testMinimumValue()
    {
        // Arrange
        $variable = new RandomFloatVariable(10, 20);

        // Act
        $result = $variable->getValue();

        // Assert
        $this->assertGreaterThanOrEqual(10, $result);
    }

    public function testMinimumValueWithDecimals()
    {
        // Arrange
        $variable = new RandomFloatVariable(10, 20, 1);

        // Act
        $result = $variable->getValue();

        // Assert
        $this->assertGreaterThanOrEqual(10.0, $result);
    }

    public function testMaximumValue()
    {
        // Arrange
        $variable = new RandomFloatVariable(10, 20);

        // Act
        $result = $variable->getValue();

        // Assert
        $this->assertLessThanOrEqual(20, $result);
    }

    public function testMaximumValueWithDecimals()
    {
        // Arrange
        $variable = new RandomFloatVariable(10, 20, 1);

        // Act
        $result = $variable->getValue();

        // Assert
        $this->assertLessThanOrEqual(20.0, $result);
    }
}
