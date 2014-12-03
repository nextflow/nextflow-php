<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Php\Action;

use NextFlow\Php\Action\EchoAction;
use NextFlow\Php\Variable\StringVariable;
use PHPUnit_Framework_TestCase;

/**
 * An action that simply echo's data.
 */
class EchoActionTest extends PHPUnit_Framework_TestCase
{
    public function testCreateSockets()
    {
        $action = new EchoAction();

        $this->assertCount(2, $action->getSockets());
        $this->assertNotNull($action->getSocket(EchoAction::SOCKET_DATA));
        $this->assertNotNull($action->getSocket(EchoAction::SOCKET_OUTPUT));
    }

    public function testExecute()
    {
        $variableNode = new StringVariable('hello');

        $action = new EchoAction();
        $action->getSocket(EchoAction::SOCKET_DATA)->addNode($variableNode);
        $action->execute();

        $this->expectOutputString('hello');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExecuteInvalid()
    {
        $variableNode = new StringVariable();

        $action = new EchoAction();
        $action->getSocket(EchoAction::SOCKET_DATA)->addNode($variableNode);
        $action->execute();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExecuteNoNodes()
    {
        $action = new EchoAction();
        $action->execute();
    }
}
