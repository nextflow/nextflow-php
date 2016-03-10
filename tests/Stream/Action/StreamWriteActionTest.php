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
use NextFlow\Php\Variable\StringVariable;
use NextFlow\Stream\Action\StreamWriteAction;
use PHPUnit_Framework_TestCase;

class StreamWriteActionTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        // Arrange
        // ...

        // Act
        $action = new StreamWriteAction();

        // Assert
        $this->assertCount(3, $action->getSockets());
    }

    public function testExecuteWithEmptyStream()
    {
        // Assert
        $this->setExpectedException('InvalidArgumentException', 'No stream to write to.');

        // Arrange
        $action = new StreamWriteAction();

        // Act
        $action->execute();
    }

    public function testExecuteWithEmptyData()
    {
        // Assert
        $this->setExpectedException('InvalidArgumentException', 'There is no data to write.');

        // Arrange
        $variable = new ResourceVariable();
        $variable->setValue(tmpfile());

        $action = new StreamWriteAction();
        $action->bind(StreamWriteAction::SOCKET_STREAM, $variable);

        // Act
        $action->execute();
    }

    public function testExecute()
    {
        // Assert
        $callback = $this->getMock(NodeInterface::class);
        $callback->expects($this->once())->method('execute');

        // Arrange
        $variableResource = new ResourceVariable();
        $variableResource->setValue(tmpfile());

        $variableData = new StringVariable();
        $variableData->setValue('test');

        $action = new StreamWriteAction();
        $action->bind(StreamWriteAction::SOCKET_STREAM, $variableResource);
        $action->bind(StreamWriteAction::SOCKET_DATA, $variableData);
        $action->bind(StreamWriteAction::SOCKET_OUTPUT, $callback);

        // Act
        $action->execute();
    }
}
