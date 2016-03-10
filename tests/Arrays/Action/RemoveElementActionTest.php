<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Arrays\Action;

use NextFlow\Arrays\Action\RemoveElementAction;
use NextFlow\Arrays\Variables\ArrayVariable;
use NextFlow\Php\Variable\IntegerVariable;
use PHPUnit_Framework_TestCase;

class RemoveElementActionTest extends PHPUnit_Framework_TestCase
{
    public function testCreateSockets()
    {
        $action = new RemoveElementAction();

        $this->assertCount(3, $action->getSockets());
        $this->assertNotNull($action->getSocket(RemoveElementAction::SOCKET_ARRAY));
        $this->assertNotNull($action->getSocket(RemoveElementAction::SOCKET_ELEMENT));
        $this->assertNotNull($action->getSocket(RemoveElementAction::SOCKET_OUTPUT));
    }

    public function testExecute()
    {
        $arrayVariable = new ArrayVariable(array(123, 456, 789));
        $elementVariable = new IntegerVariable(123);

        $action = new RemoveElementAction();
        $action->bind(RemoveElementAction::SOCKET_ARRAY, $arrayVariable);
        $action->bind(RemoveElementAction::SOCKET_ELEMENT, $elementVariable);
        $action->execute();

        $this->assertSame(array(1 => 456, 2 => 789), $arrayVariable->getValue());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExecuteNoArray()
    {
        $elementVariable = new IntegerVariable(123);

        $action = new RemoveElementAction();
        $action->bind(RemoveElementAction::SOCKET_ELEMENT, $elementVariable);
        $action->execute();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExecuteNoElement()
    {
        $arrayVariable = new ArrayVariable(array(123, 456, 789));

        $action = new RemoveElementAction();
        $action->bind(RemoveElementAction::SOCKET_ARRAY, $arrayVariable);
        $action->execute();
    }
}
