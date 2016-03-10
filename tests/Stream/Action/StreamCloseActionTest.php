<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Stream\Action;

use NextFlow\Core\Node\NodeInterface;
use NextFlow\Php\Variable\ResourceVariable;
use NextFlow\Stream\Action\StreamCloseAction;
use PHPUnit_Framework_TestCase;

class StreamCloseActionTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        // Arrange
        // ...

        // Act
        $action = new StreamCloseAction();

        // Assert
        $this->assertCount(2, $action->getSockets());
    }

    public function testExecuteWithEmptySocket()
    {
        // Assert
        $this->setExpectedException('InvalidArgumentException', 'There is no stream to close.');

        // Arrange
        $action = new StreamCloseAction();

        // Act
        $action->execute();
    }

    public function testExecuteWithInvalidStream()
    {
        // Assert
        $this->setExpectedException('InvalidArgumentException', 'Invalid stream provided.');

        // Arrange
        $variable = new ResourceVariable();
        $variable->setValue(123);

        $action = new StreamCloseAction();
        $action->bind(StreamCloseAction::SOCKET_STREAM, $variable);

        // Act
        $action->execute();
    }

    public function testExecute()
    {
        // Assert
        $callback = $this->getMockForAbstractClass(NodeInterface::class);
        $callback->expects($this->once())->method('execute');

        // Arrange
        $variable = new ResourceVariable();
        $variable->setValue(tmpfile());

        $action = new StreamCloseAction();
        $action->bind(StreamCloseAction::SOCKET_STREAM, $variable);
        $action->bind(StreamCloseAction::SOCKET_OUTPUT, $callback);

        // Act
        $action->execute();
    }
}
