<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
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
        ob_start();

        $variableNode = new StringVariable('hello');

        $action = new VarDumpAction();
        $action->getSocket(VarDumpAction::SOCKET_DATA)->addNode($variableNode);
        $action->execute();

        $content = ob_get_clean();

        $this->assertRegExp('/string\(5\) "hello"/', $content);
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
