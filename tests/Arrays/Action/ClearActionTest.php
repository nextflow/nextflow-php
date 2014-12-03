<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Arrays\Action;

use NextFlow\Arrays\Action\ClearAction;
use NextFlow\Arrays\Variables\ArrayVariable;
use PHPUnit_Framework_TestCase;

class ClearActionTest extends PHPUnit_Framework_TestCase
{
    public function testCreateSockets()
    {
        $action = new ClearAction();

        $this->assertCount(2, $action->getSockets());
        $this->assertNotNull($action->getSocket(ClearAction::SOCKET_ARRAY));
        $this->assertNotNull($action->getSocket(ClearAction::SOCKET_OUTPUT));
    }

    public function testExecute()
    {
        $variable = new ArrayVariable(array(0, 1, 2));

        $action = new ClearAction();
        $action->bind(ClearAction::SOCKET_ARRAY, $variable);
        $action->execute();

        $this->assertCount(0, $variable->getValue());
    }

    public function testExecuteNoData()
    {
        $variable = new ArrayVariable();

        $action = new ClearAction();
        $action->bind(ClearAction::SOCKET_ARRAY, $variable);
        $action->execute();

        $this->assertCount(0, $variable->getValue());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExecuteNoNode()
    {
        $action = new ClearAction();
        $action->execute();
    }
}
