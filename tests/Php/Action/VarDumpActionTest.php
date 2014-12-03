<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Php\Action;

use InvalidArgumentException;
use NextFlow\Php\Action\VarDumpAction;
use NextFlow\Php\Variable\StringVariable;
use PHPUnit_Framework_TestCase;

class VarDumpActionTest extends PHPUnit_Framework_TestCase
{
    public function testSocketCreation()
    {
        $action = new VarDumpAction();

        $this->assertCount(2, $action->getSockets());
        $this->assertNotNull($action->getSocket(VarDumpAction::SOCKET_DATA));
        $this->assertNotNull($action->getSocket(VarDumpAction::SOCKET_OUTPUT));
    }

    public function testExecute()
    {
        $variableNode = new StringVariable('hello');

        $action = new VarDumpAction();
        $action->getSocket(VarDumpAction::SOCKET_DATA)->addNode($variableNode);
        $action->execute();

        $this->expectOutputString('string(5) "hello"' . "\n");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testExecuteInvalid()
    {
        $variableNode = new StringVariable();

        $action = new VarDumpAction();
        $action->getSocket(VarDumpAction::SOCKET_DATA)->addNode($variableNode);
        $action->execute();
    }

    public function testExecuteNoNodes()
    {
        $action = new VarDumpAction();
        $action->execute();
    }
}
