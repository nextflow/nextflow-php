<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Math\Action;

use InvalidArgumentException;
use NextFlow\Math\Action\DivideAction;
use NextFlow\Php\Variable\IntegerVariable;
use PHPUnit_Framework_TestCase;

class DivideActionTest extends PHPUnit_Framework_TestCase
{
    public function testCreateSockets()
    {
        $action = new DivideAction();

        $this->assertCount(4, $action->getSockets());
        $this->assertNotNull($action->getSocket(DivideAction::SOCKET_LFT));
        $this->assertNotNull($action->getSocket(DivideAction::SOCKET_OUTPUT));
        $this->assertNotNull($action->getSocket(DivideAction::SOCKET_RESULT));
        $this->assertNotNull($action->getSocket(DivideAction::SOCKET_RGT));
    }

    public function testCalculateValue()
    {
        $lftVariable = new IntegerVariable(10);
        $rgtVariable = new IntegerVariable(2);
        $resultVariable = new IntegerVariable();

        $action = new DivideAction();
        $action->bind(DivideAction::SOCKET_LFT, $lftVariable);
        $action->bind(DivideAction::SOCKET_RGT, $rgtVariable);
        $action->bind(DivideAction::SOCKET_RESULT, $resultVariable);
        $action->execute();

        $this->assertSame(5, $resultVariable->getValue());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCalculateValueNoLft()
    {
        $rgtVariable = new IntegerVariable(123);
        $resultVariable = new IntegerVariable();

        $action = new DivideAction();
        $action->bind(DivideAction::SOCKET_RGT, $rgtVariable);
        $action->bind(DivideAction::SOCKET_RESULT, $resultVariable);
        $action->execute();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCalculateValueNoRgt()
    {
        $lftVariable = new IntegerVariable(123);
        $resultVariable = new IntegerVariable();

        $action = new DivideAction();
        $action->bind(DivideAction::SOCKET_LFT, $lftVariable);
        $action->bind(DivideAction::SOCKET_RESULT, $resultVariable);
        $action->execute();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCalculateValueNoResult()
    {
        $lftVariable = new IntegerVariable(123);
        $rgtVariable = new IntegerVariable(123);

        $action = new DivideAction();
        $action->bind(DivideAction::SOCKET_LFT, $lftVariable);
        $action->bind(DivideAction::SOCKET_RGT, $rgtVariable);
        $action->execute();
    }
}
