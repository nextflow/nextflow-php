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
use NextFlow\Php\Action\PrintRAction;
use NextFlow\Php\Variable\StringVariable;
use PHPUnit_Framework_TestCase;

class PrintRActionTest extends PHPUnit_Framework_TestCase
{
    public function testSocketCreation()
    {
        $action = new PrintRAction();

        $this->assertCount(2, $action->getSockets());
        $this->assertNotNull($action->getSocket(PrintRAction::SOCKET_DATA));
        $this->assertNotNull($action->getSocket(PrintRAction::SOCKET_OUTPUT));
    }

    public function testExecute()
    {
        $variableNode = new StringVariable('hello');

        $action = new PrintRAction();
        $action->getSocket(PrintRAction::SOCKET_DATA)->addNode($variableNode);
        $action->execute();

        $this->expectOutputString('hello');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testExecuteInvalid()
    {
        $variableNode = new StringVariable();

        $action = new PrintRAction();
        $action->getSocket(PrintRAction::SOCKET_DATA)->addNode($variableNode);
        $action->execute();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExecuteNoNodes()
    {
        $action = new PrintRAction();
        $action->execute();
    }
}
