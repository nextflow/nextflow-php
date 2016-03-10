<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Math\Action;

use InvalidArgumentException;
use NextFlow\Math\Action\MultiplyAction;
use NextFlow\Php\Variable\IntegerVariable;
use PHPUnit_Framework_TestCase;

class MultiplyActionTest extends PHPUnit_Framework_TestCase
{
    public function testCreateSockets()
    {
        $action = new MultiplyAction();

        $this->assertCount(4, $action->getSockets());
        $this->assertNotNull($action->getSocket(MultiplyAction::SOCKET_LFT));
        $this->assertNotNull($action->getSocket(MultiplyAction::SOCKET_OUTPUT));
        $this->assertNotNull($action->getSocket(MultiplyAction::SOCKET_RESULT));
        $this->assertNotNull($action->getSocket(MultiplyAction::SOCKET_RGT));
    }

    public function testCalculateValue()
    {
        $lftVariable = new IntegerVariable(1000);
        $rgtVariable = new IntegerVariable(3);
        $resultVariable = new IntegerVariable();

        $action = new MultiplyAction();
        $action->bind(MultiplyAction::SOCKET_LFT, $lftVariable);
        $action->bind(MultiplyAction::SOCKET_RGT, $rgtVariable);
        $action->bind(MultiplyAction::SOCKET_RESULT, $resultVariable);
        $action->execute();

        $this->assertSame(3000, $resultVariable->getValue());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCalculateValueNoLft()
    {
        $rgtVariable = new IntegerVariable(123);
        $resultVariable = new IntegerVariable();

        $action = new MultiplyAction();
        $action->bind(MultiplyAction::SOCKET_RGT, $rgtVariable);
        $action->bind(MultiplyAction::SOCKET_RESULT, $resultVariable);
        $action->execute();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCalculateValueNoRgt()
    {
        $lftVariable = new IntegerVariable(123);
        $resultVariable = new IntegerVariable();

        $action = new MultiplyAction();
        $action->bind(MultiplyAction::SOCKET_LFT, $lftVariable);
        $action->bind(MultiplyAction::SOCKET_RESULT, $resultVariable);
        $action->execute();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCalculateValueNoResult()
    {
        $lftVariable = new IntegerVariable(123);
        $rgtVariable = new IntegerVariable(123);

        $action = new MultiplyAction();
        $action->bind(MultiplyAction::SOCKET_LFT, $lftVariable);
        $action->bind(MultiplyAction::SOCKET_RGT, $rgtVariable);
        $action->execute();
    }
}
