<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Mail\Action;

use NextFlow\Mail\Action\SendMailAction;
use PHPUnit_Framework_TestCase;

class SendMailActionTest extends PHPUnit_Framework_TestCase
{
    public function testSocketCreation()
    {
        $action = new SendMailAction();

        $this->assertCount(6, $action->getSockets());
        $this->assertNotNull($action->getSocket(SendMailAction::SOCKET_FROM));
        $this->assertNotNull($action->getSocket(SendMailAction::SOCKET_MESSAGE));
        $this->assertNotNull($action->getSocket(SendMailAction::SOCKET_OUTPUT_ERROR));
        $this->assertNotNull($action->getSocket(SendMailAction::SOCKET_OUTPUT_SUCCESS));
        $this->assertNotNull($action->getSocket(SendMailAction::SOCKET_SUBJECT));
        $this->assertNotNull($action->getSocket(SendMailAction::SOCKET_TO));
    }
}
