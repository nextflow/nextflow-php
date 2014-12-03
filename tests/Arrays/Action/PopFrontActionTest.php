<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Arrays\Action;

use NextFlow\Arrays\Action\PopFrontAction;
use NextFlow\Arrays\Variables\ArrayVariable;
use NextFlow\Php\Variable\IntegerVariable;
use PHPUnit_Framework_TestCase;

class PopFrontActionTest extends PHPUnit_Framework_TestCase
{
    public function testCreateSockets()
    {
        $action = new PopFrontAction();

        $this->assertCount(3, $action->getSockets());
        $this->assertNotNull($action->getSocket(PopFrontAction::SOCKET_ARRAY));
        $this->assertNotNull($action->getSocket(PopFrontAction::SOCKET_DATA));
        $this->assertNotNull($action->getSocket(PopFrontAction::SOCKET_OUTPUT));
    }

    public function testExecute()
    {
        $arrayVariable = new ArrayVariable(array(0, 1, 2));
        $dataVariable = new IntegerVariable();

        $action = new PopFrontAction();
        $action->bind(PopFrontAction::SOCKET_ARRAY, $arrayVariable);
        $action->bind(PopFrontAction::SOCKET_DATA, $dataVariable);
        $action->execute();

        $this->assertSame(0, $dataVariable->getValue());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExecuteNoArray()
    {
        $action = new PopFrontAction();
        $action->execute();
    }

    public function testExecuteNoData()
    {
        $arrayVariable = new ArrayVariable(array(0, 1, 2));

        $action = new PopFrontAction();
        $action->bind(PopFrontAction::SOCKET_ARRAY, $arrayVariable);
        $action->execute();

        $this->assertSame(array(1, 2), $arrayVariable->getValue());
    }
}
