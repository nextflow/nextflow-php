<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Php\Action;

use NextFlow\Php\Action\CallbackAction;
use PHPUnit_Framework_TestCase;

class CallbackActionTest extends PHPUnit_Framework_TestCase
{
    public function testCallback()
    {
        $variable = false;

        $callback = function () use (&$variable) {
            $variable = true;
        };

        $action = new CallbackAction($callback);
        $action->execute();

        $this->assertSame(true, $variable);
    }

    public function testSocketCreation()
    {
        $callback = function () {

        };

        $action = new CallbackAction($callback);

        $this->assertCount(1, $action->getSockets());
        $this->assertNotNull($action->getSocket(CallbackAction::SOCKET_OUTPUT));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testNoCallback()
    {
        new CallbackAction(null);
    }
}
