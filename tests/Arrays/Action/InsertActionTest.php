<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Arrays\Action;

use NextFlow\Arrays\Action\InsertAction;
use NextFlow\Arrays\Variables\ArrayVariable;
use NextFlow\Php\Variable\IntegerVariable;
use PHPUnit_Framework_TestCase;

class InsertActionTest extends PHPUnit_Framework_TestCase
{
    public function testCreateSockets()
    {
        $action = new InsertAction();

        $this->assertCount(4, $action->getSockets());
        $this->assertNotNull($action->getSocket(InsertAction::SOCKET_ARRAY));
        $this->assertNotNull($action->getSocket(InsertAction::SOCKET_INDEX));
        $this->assertNotNull($action->getSocket(InsertAction::SOCKET_OUTPUT));
        $this->assertNotNull($action->getSocket(InsertAction::SOCKET_VALUE));
    }

    public function testExecute()
    {
        $arrayVariable = new ArrayVariable(array(0, 1, 2));
        $indexVariable = new IntegerVariable(2);
        $valueVariable = new IntegerVariable(3);

        $action = new InsertAction();
        $action->bind(InsertAction::SOCKET_ARRAY, $arrayVariable);
        $action->bind(InsertAction::SOCKET_INDEX, $indexVariable);
        $action->bind(InsertAction::SOCKET_VALUE, $valueVariable);
        $action->execute();

        $this->assertSame(array(0, 1, 3, 2), $arrayVariable->getValue());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExecuteNoArray()
    {
        $indexVariable = new IntegerVariable(2);
        $valueVariable = new IntegerVariable(3);

        $action = new InsertAction();
        $action->bind(InsertAction::SOCKET_INDEX, $indexVariable);
        $action->bind(InsertAction::SOCKET_VALUE, $valueVariable);
        $action->execute();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExecuteNoIndex()
    {
        $arrayVariable = new ArrayVariable(array(0, 1, 2));
        $valueVariable = new IntegerVariable(3);

        $action = new InsertAction();
        $action->bind(InsertAction::SOCKET_ARRAY, $arrayVariable);
        $action->bind(InsertAction::SOCKET_VALUE, $valueVariable);
        $action->execute();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExecuteValue()
    {
        $arrayVariable = new ArrayVariable(array(0, 1, 2));
        $indexVariable = new IntegerVariable(2);

        $action = new InsertAction();
        $action->bind(InsertAction::SOCKET_ARRAY, $arrayVariable);
        $action->bind(InsertAction::SOCKET_INDEX, $indexVariable);
        $action->execute();
    }
}
