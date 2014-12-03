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
use NextFlow\Math\Action\SubtractAction;
use NextFlow\Php\Variable\IntegerVariable;
use PHPUnit_Framework_TestCase;

class SubtractActionTest extends PHPUnit_Framework_TestCase
{
    public function testCreateSockets()
    {
        $action = new SubtractAction();

        $this->assertCount(4, $action->getSockets());
        $this->assertNotNull($action->getSocket(SubtractAction::SOCKET_LFT));
        $this->assertNotNull($action->getSocket(SubtractAction::SOCKET_OUTPUT));
        $this->assertNotNull($action->getSocket(SubtractAction::SOCKET_RESULT));
        $this->assertNotNull($action->getSocket(SubtractAction::SOCKET_RGT));
    }

    public function testCalculateValue()
    {
        $lftVariable = new IntegerVariable(500);
        $rgtVariable = new IntegerVariable(200);
        $resultVariable = new IntegerVariable();

        $action = new SubtractAction();
        $action->bind(SubtractAction::SOCKET_LFT, $lftVariable);
        $action->bind(SubtractAction::SOCKET_RGT, $rgtVariable);
        $action->bind(SubtractAction::SOCKET_RESULT, $resultVariable);
        $action->execute();

        $this->assertSame(300, $resultVariable->getValue());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCalculateValueNoLft()
    {
        $rgtVariable = new IntegerVariable(123);
        $resultVariable = new IntegerVariable();

        $action = new SubtractAction();
        $action->bind(SubtractAction::SOCKET_RGT, $rgtVariable);
        $action->bind(SubtractAction::SOCKET_RESULT, $resultVariable);
        $action->execute();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCalculateValueNoRgt()
    {
        $lftVariable = new IntegerVariable(123);
        $resultVariable = new IntegerVariable();

        $action = new SubtractAction();
        $action->bind(SubtractAction::SOCKET_LFT, $lftVariable);
        $action->bind(SubtractAction::SOCKET_RESULT, $resultVariable);
        $action->execute();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCalculateValueNoResult()
    {
        $lftVariable = new IntegerVariable(123);
        $rgtVariable = new IntegerVariable(123);

        $action = new SubtractAction();
        $action->bind(SubtractAction::SOCKET_LFT, $lftVariable);
        $action->bind(SubtractAction::SOCKET_RGT, $rgtVariable);
        $action->execute();
    }
}
