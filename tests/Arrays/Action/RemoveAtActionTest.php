<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Arrays\Action;

use NextFlow\Arrays\Action\RemoveAtAction;
use NextFlow\Arrays\Variables\ArrayVariable;
use NextFlow\Php\Variable\IntegerVariable;
use PHPUnit_Framework_TestCase;

class RemoveAtActionTest extends PHPUnit_Framework_TestCase
{
    public function testCreateSockets()
    {
        $action = new RemoveAtAction();

        $this->assertCount(4, $action->getSockets());
        $this->assertNotNull($action->getSocket(RemoveAtAction::SOCKET_ARRAY));
        $this->assertNotNull($action->getSocket(RemoveAtAction::SOCKET_DATA));
        $this->assertNotNull($action->getSocket(RemoveAtAction::SOCKET_INDEX));
        $this->assertNotNull($action->getSocket(RemoveAtAction::SOCKET_OUTPUT));
    }

    public function testExecute()
    {
        $arrayVariable = new ArrayVariable(array(123, 456, 789));
        $indexVariable = new IntegerVariable(1);
        $dataVariable = new IntegerVariable(3);

        $action = new RemoveAtAction();
        $action->bind(RemoveAtAction::SOCKET_ARRAY, $arrayVariable);
        $action->bind(RemoveAtAction::SOCKET_INDEX, $indexVariable);
        $action->bind(RemoveAtAction::SOCKET_DATA, $dataVariable);
        $action->execute();

        $this->assertSame(array(0 => 123, 2 => 789), $arrayVariable->getValue());
        $this->assertSame(456, $dataVariable->getValue());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExecuteNoArray()
    {
        $indexVariable = new IntegerVariable(1);
        $dataVariable = new IntegerVariable(3);

        $action = new RemoveAtAction();
        $action->bind(RemoveAtAction::SOCKET_INDEX, $indexVariable);
        $action->bind(RemoveAtAction::SOCKET_DATA, $dataVariable);
        $action->execute();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExecuteNoIndex()
    {
        $arrayVariable = new ArrayVariable(array(123, 456, 789));
        $dataVariable = new IntegerVariable(3);

        $action = new RemoveAtAction();
        $action->bind(RemoveAtAction::SOCKET_ARRAY, $arrayVariable);
        $action->bind(RemoveAtAction::SOCKET_DATA, $dataVariable);
        $action->execute();
    }

    public function testExecuteNoData()
    {
        $arrayVariable = new ArrayVariable(array(123, 456, 789));
        $indexVariable = new IntegerVariable(1);

        $action = new RemoveAtAction();
        $action->bind(RemoveAtAction::SOCKET_ARRAY, $arrayVariable);
        $action->bind(RemoveAtAction::SOCKET_INDEX, $indexVariable);
        $action->execute();

        $this->assertSame(array(0 => 123, 2 => 789), $arrayVariable->getValue());
    }
}
