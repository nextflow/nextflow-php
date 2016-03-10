<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Core\Scene;

use NextFlow\Php\Variable\AnyVariable;
use NextFlow\Core\Condition\RangeCondition;

class RangeConditionTest extends \PHPUnit_Framework_TestCase
{
    public function testWithinRange()
    {
        // Arrange
        $neverAction = $this->getMock('NextFlow\Core\Action\AbstractAction', array('execute'));
        $neverAction->expects($this->never())->method('execute');

        $action = $this->getMock('NextFlow\Core\Action\AbstractAction', array('execute'));
        $action->expects($this->once())->method('execute');

        $condition = new RangeCondition();
        $condition->bind(RangeCondition::SOCKET_TRUE, $action);
        $condition->bind(RangeCondition::SOCKET_FALSE, $neverAction);
        $condition->bind(RangeCondition::SOCKET_MIN, new AnyVariable(1));
        $condition->bind(RangeCondition::SOCKET_MAX, new AnyVariable(5));
        $condition->bind(RangeCondition::SOCKET_VALUE, new AnyVariable(2));

        // Act
        $condition->execute();

        // Assert
        // ...
    }

    public function testEqualToMinimum()
    {
        // Arrange
        $neverAction = $this->getMock('NextFlow\Core\Action\AbstractAction', array('execute'));
        $neverAction->expects($this->never())->method('execute');

        $action = $this->getMock('NextFlow\Core\Action\AbstractAction', array('execute'));
        $action->expects($this->once())->method('execute');

        $condition = new RangeCondition();
        $condition->bind(RangeCondition::SOCKET_TRUE, $action);
        $condition->bind(RangeCondition::SOCKET_FALSE, $neverAction);
        $condition->bind(RangeCondition::SOCKET_MIN, new AnyVariable(1));
        $condition->bind(RangeCondition::SOCKET_MAX, new AnyVariable(5));
        $condition->bind(RangeCondition::SOCKET_VALUE, new AnyVariable(1));

        // Act
        $condition->execute();

        // Assert
        // ...
    }

    public function testEqualToMaximum()
    {
        // Arrange
        $neverAction = $this->getMock('NextFlow\Core\Action\AbstractAction', array('execute'));
        $neverAction->expects($this->never())->method('execute');

        $action = $this->getMock('NextFlow\Core\Action\AbstractAction', array('execute'));
        $action->expects($this->once())->method('execute');

        $condition = new RangeCondition();
        $condition->bind(RangeCondition::SOCKET_TRUE, $action);
        $condition->bind(RangeCondition::SOCKET_FALSE, $neverAction);
        $condition->bind(RangeCondition::SOCKET_MIN, new AnyVariable(1));
        $condition->bind(RangeCondition::SOCKET_MAX, new AnyVariable(5));
        $condition->bind(RangeCondition::SOCKET_VALUE, new AnyVariable(5));

        // Act
        $condition->execute();

        // Assert
        // ...
    }

    public function testLessThanRange()
    {
        // Arrange
        $neverAction = $this->getMock('NextFlow\Core\Action\AbstractAction', array('execute'));
        $neverAction->expects($this->never())->method('execute');

        $action = $this->getMock('NextFlow\Core\Action\AbstractAction', array('execute'));
        $action->expects($this->once())->method('execute');

        $condition = new RangeCondition();
        $condition->bind(RangeCondition::SOCKET_TRUE, $neverAction);
        $condition->bind(RangeCondition::SOCKET_FALSE, $action);
        $condition->bind(RangeCondition::SOCKET_MIN, new AnyVariable(1));
        $condition->bind(RangeCondition::SOCKET_MAX, new AnyVariable(5));
        $condition->bind(RangeCondition::SOCKET_VALUE, new AnyVariable(0));

        // Act
        $condition->execute();

        // Assert
        // ...
    }

    public function testGreaterThanRange()
    {
        // Arrange
        $neverAction = $this->getMock('NextFlow\Core\Action\AbstractAction', array('execute'));
        $neverAction->expects($this->never())->method('execute');

        $action = $this->getMock('NextFlow\Core\Action\AbstractAction', array('execute'));
        $action->expects($this->once())->method('execute');

        $condition = new RangeCondition();
        $condition->bind(RangeCondition::SOCKET_TRUE, $neverAction);
        $condition->bind(RangeCondition::SOCKET_FALSE, $action);
        $condition->bind(RangeCondition::SOCKET_MIN, new AnyVariable(1));
        $condition->bind(RangeCondition::SOCKET_MAX, new AnyVariable(5));
        $condition->bind(RangeCondition::SOCKET_VALUE, new AnyVariable(6));

        // Act
        $condition->execute();

        // Assert
        // ...
    }
}
