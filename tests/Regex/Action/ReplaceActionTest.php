<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Regex\Action;

use NextFlow\Regex\Action\ReplaceAction;
use PHPUnit_Framework_TestCase;

class ReplaceActionTest extends PHPUnit_Framework_TestCase
{
    public function testCreateSockets()
    {
        $action = new ReplaceAction();

        $this->assertCount(5, $action->getSockets());
        $this->assertNotNull($action->getSocket(ReplaceAction::SOCKET_OUTPUT));
        $this->assertNotNull($action->getSocket(ReplaceAction::SOCKET_PATTERN));
        $this->assertNotNull($action->getSocket(ReplaceAction::SOCKET_REPLACEMENT));
        $this->assertNotNull($action->getSocket(ReplaceAction::SOCKET_RESULT));
        $this->assertNotNull($action->getSocket(ReplaceAction::SOCKET_SUBJECT));
    }

    public function testExecute()
    {
        $patternVariable = new \NextFlow\Php\Variable\StringVariable('/e/i');
        $replacementVariable = new \NextFlow\Php\Variable\StringVariable('3');
        $resultVariable = new \NextFlow\Php\Variable\StringVariable();
        $subjectVariable = new \NextFlow\Php\Variable\StringVariable('hello');

        $action = new ReplaceAction();
        $action->bind(ReplaceAction::SOCKET_PATTERN, $patternVariable);
        $action->bind(ReplaceAction::SOCKET_REPLACEMENT, $replacementVariable);
        $action->bind(ReplaceAction::SOCKET_RESULT, $resultVariable);
        $action->bind(ReplaceAction::SOCKET_SUBJECT, $subjectVariable);
        $action->execute();

        $this->assertSame('h3llo', $resultVariable->getValue());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExecuteNoPattern()
    {
        $replacementVariable = new \NextFlow\Php\Variable\StringVariable('3');
        $resultVariable = new \NextFlow\Php\Variable\StringVariable();
        $subjectVariable = new \NextFlow\Php\Variable\StringVariable('hello');

        $action = new ReplaceAction();
        $action->bind(ReplaceAction::SOCKET_REPLACEMENT, $replacementVariable);
        $action->bind(ReplaceAction::SOCKET_RESULT, $resultVariable);
        $action->bind(ReplaceAction::SOCKET_SUBJECT, $subjectVariable);
        $action->execute();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExecuteNoReplacement()
    {
        $patternVariable = new \NextFlow\Php\Variable\StringVariable('/e/i');
        $resultVariable = new \NextFlow\Php\Variable\StringVariable();
        $subjectVariable = new \NextFlow\Php\Variable\StringVariable('hello');

        $action = new ReplaceAction();
        $action->bind(ReplaceAction::SOCKET_PATTERN, $patternVariable);
        $action->bind(ReplaceAction::SOCKET_RESULT, $resultVariable);
        $action->bind(ReplaceAction::SOCKET_SUBJECT, $subjectVariable);
        $action->execute();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExecuteNoResult()
    {
        $patternVariable = new \NextFlow\Php\Variable\StringVariable('/e/i');
        $replacementVariable = new \NextFlow\Php\Variable\StringVariable('3');
        $subjectVariable = new \NextFlow\Php\Variable\StringVariable('hello');

        $action = new ReplaceAction();
        $action->bind(ReplaceAction::SOCKET_PATTERN, $patternVariable);
        $action->bind(ReplaceAction::SOCKET_REPLACEMENT, $replacementVariable);
        $action->bind(ReplaceAction::SOCKET_SUBJECT, $subjectVariable);
        $action->execute();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExecuteNoSubject()
    {
        $patternVariable = new \NextFlow\Php\Variable\StringVariable('/e/i');
        $replacementVariable = new \NextFlow\Php\Variable\StringVariable('3');
        $resultVariable = new \NextFlow\Php\Variable\StringVariable();

        $action = new ReplaceAction();
        $action->bind(ReplaceAction::SOCKET_PATTERN, $patternVariable);
        $action->bind(ReplaceAction::SOCKET_REPLACEMENT, $replacementVariable);
        $action->bind(ReplaceAction::SOCKET_RESULT, $resultVariable);
        $action->execute();
    }
}
