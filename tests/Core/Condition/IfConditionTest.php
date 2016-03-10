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
use NextFlow\Core\Condition\IfCondition;

class IfConditionTest extends \PHPUnit_Framework_TestCase
{
    public function testEquals()
    {
        // Arrange
        $neverAction = $this->getMock('NextFlow\Core\Action\AbstractAction', array('execute'));
        $neverAction->expects($this->never())->method('execute');

        $action = $this->getMock('NextFlow\Core\Action\AbstractAction', array('execute'));
        $action->expects($this->once())->method('execute');

        $condition = new IfCondition();
        $condition->bind(IfCondition::SOCKET_VALUELFT, new AnyVariable(22));
        $condition->bind(IfCondition::SOCKET_VALUERGT, new AnyVariable(22));
        $condition->bind(IfCondition::SOCKET_EQUAL, $action);
        $condition->bind(IfCondition::SOCKET_NOT_EQUAL, $neverAction);
        $condition->bind(IfCondition::SOCKET_LESS_THAN, $neverAction);
        $condition->bind(IfCondition::SOCKET_GREATER_THAN, $neverAction);

        // Act
        $condition->execute();

        // Assert
        // ...
    }

    public function testNotEqualAndLessThen()
    {
        // Arrange
        $neverAction = $this->getMock('NextFlow\Core\Action\AbstractAction', array('execute'));
        $neverAction->expects($this->never())->method('execute');

        $action = $this->getMock('NextFlow\Core\Action\AbstractAction', array('execute'));
        $action->expects($this->exactly(2))->method('execute');

        $condition = new IfCondition();
        $condition->bind(IfCondition::SOCKET_VALUELFT, new AnyVariable(22));
        $condition->bind(IfCondition::SOCKET_VALUERGT, new AnyVariable(33));
        $condition->bind(IfCondition::SOCKET_EQUAL, $neverAction);
        $condition->bind(IfCondition::SOCKET_NOT_EQUAL, $action);
        $condition->bind(IfCondition::SOCKET_LESS_THAN, $action);
        $condition->bind(IfCondition::SOCKET_GREATER_THAN, $neverAction);

        // Act
        $condition->execute();

        // Assert
        // ...
    }

    public function testNotEqualAndGreaterThen()
    {
        // Arrange
        $neverAction = $this->getMock('NextFlow\Core\Action\AbstractAction', array('execute'));
        $neverAction->expects($this->never())->method('execute');

        $action = $this->getMock('NextFlow\Core\Action\AbstractAction', array('execute'));
        $action->expects($this->exactly(2))->method('execute');

        $condition = new IfCondition();
        $condition->bind(IfCondition::SOCKET_VALUELFT, new AnyVariable(33));
        $condition->bind(IfCondition::SOCKET_VALUERGT, new AnyVariable(22));
        $condition->bind(IfCondition::SOCKET_EQUAL, $neverAction);
        $condition->bind(IfCondition::SOCKET_NOT_EQUAL, $action);
        $condition->bind(IfCondition::SOCKET_LESS_THAN, $neverAction);
        $condition->bind(IfCondition::SOCKET_GREATER_THAN, $action);

        // Act
        $condition->execute();

        // Assert
        // ...
    }
}
