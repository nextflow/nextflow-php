<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Math\Action;

use NextFlow\Math\Action\AddAction;
use NextFlow\Php\Variable\IntegerVariable;

class AddActionTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateSockets()
    {
        $action = new AddAction();

        $this->assertCount(4, $action->getSockets());
        $this->assertNotNull($action->getSocket(AddAction::SOCKET_LFT));
        $this->assertNotNull($action->getSocket(AddAction::SOCKET_OUTPUT));
        $this->assertNotNull($action->getSocket(AddAction::SOCKET_RESULT));
        $this->assertNotNull($action->getSocket(AddAction::SOCKET_RGT));
    }

    public function testCalculateValue()
    {
        $lftVariable = new IntegerVariable(123);
        $rgtVariable = new IntegerVariable(123);
        $resultVariable = new IntegerVariable();

        $action = new AddAction();
        $action->bind(AddAction::SOCKET_LFT, $lftVariable);
        $action->bind(AddAction::SOCKET_RGT, $rgtVariable);
        $action->bind(AddAction::SOCKET_RESULT, $resultVariable);
        $action->execute();

        $this->assertSame(246, $resultVariable->getValue());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCalculateValueNoLft()
    {
        $rgtVariable = new IntegerVariable(123);
        $resultVariable = new IntegerVariable();

        $action = new AddAction();
        $action->bind(AddAction::SOCKET_RGT, $rgtVariable);
        $action->bind(AddAction::SOCKET_RESULT, $resultVariable);
        $action->execute();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCalculateValueNoRgt()
    {
        $lftVariable = new IntegerVariable(123);
        $resultVariable = new IntegerVariable();

        $action = new AddAction();
        $action->bind(AddAction::SOCKET_LFT, $lftVariable);
        $action->bind(AddAction::SOCKET_RESULT, $resultVariable);
        $action->execute();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCalculateValueNoResult()
    {
        $lftVariable = new IntegerVariable(123);
        $rgtVariable = new IntegerVariable(123);

        $action = new AddAction();
        $action->bind(AddAction::SOCKET_LFT, $lftVariable);
        $action->bind(AddAction::SOCKET_RGT, $rgtVariable);
        $action->execute();
    }
}
