<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Arrays\Action;

use NextFlow\Arrays\Action\PushBackAction;
use NextFlow\Arrays\Variables\ArrayVariable;
use NextFlow\Php\Variable\IntegerVariable;
use PHPUnit_Framework_TestCase;

class PushBackActionTest extends PHPUnit_Framework_TestCase
{
    public function testCreateSockets()
    {
        $action = new PushBackAction();

        $this->assertCount(3, $action->getSockets());
        $this->assertNotNull($action->getSocket(PushBackAction::SOCKET_ARRAY));
        $this->assertNotNull($action->getSocket(PushBackAction::SOCKET_DATA));
        $this->assertNotNull($action->getSocket(PushBackAction::SOCKET_OUTPUT));
    }

    public function testExecute()
    {
        $arrayVariable = new ArrayVariable(array(0, 1, 2));
        $dataVariable = new IntegerVariable(3);

        $action = new PushBackAction();
        $action->bind(PushBackAction::SOCKET_ARRAY, $arrayVariable);
        $action->bind(PushBackAction::SOCKET_DATA, $dataVariable);
        $action->execute();

        $this->assertSame(array(0, 1, 2, 3), $arrayVariable->getValue());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExecuteNoArray()
    {
        $dataVariable = new IntegerVariable(123);

        $action = new PushBackAction();
        $action->bind(PushBackAction::SOCKET_DATA, $dataVariable);
        $action->execute();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExecuteNoData()
    {
        $arrayVariable = new ArrayVariable(array(0, 1, 2));

        $action = new PushBackAction();
        $action->bind(PushBackAction::SOCKET_ARRAY, $arrayVariable);
        $action->execute();
    }
}
