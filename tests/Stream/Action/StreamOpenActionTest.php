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
use NextFlow\Stream\Action\StreamOpenAction;
use PHPUnit_Framework_TestCase;

class StreamOpenActionTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        // Arrange
        // ...

        // Act
        $action = new StreamOpenAction();

        // Assert
        $this->assertCount(4, $action->getSockets());
    }

    public function testExecuteWithEmptyFilenameSocket()
    {
        // Assert
        $this->setExpectedException('InvalidArgumentException', 'There is no filename provided.');

        // Arrange
        $action = new StreamOpenAction();

        // Act
        $action->execute();
    }

    public function testExecuteWithEmptyModeSocket()
    {
        // Assert
        $this->setExpectedException('InvalidArgumentException', 'There is no stream mode provided.');

        // Arrange
        $variable = new StringVariable();
        $variable->setValue(tempnam(sys_get_temp_dir(), 'test'));

        $action = new StreamOpenAction();
        $action->bind(StreamOpenAction::SOCKET_FILENAME, $variable);

        // Act
        $action->execute();
    }

    public function testExecuteWithEmptyStreamSocket()
    {
        // Assert
        $this->setExpectedException('InvalidArgumentException', 'There is no stream variable provided.');

        // Arrange
        $variableFile = new StringVariable();
        $variableFile->setValue(tempnam(sys_get_temp_dir(), 'test'));

        $variableMode = new StringVariable();
        $variableMode->setValue('w');

        $action = new StreamOpenAction();
        $action->bind(StreamOpenAction::SOCKET_FILENAME, $variableFile);
        $action->bind(StreamOpenAction::SOCKET_MODE, $variableMode);

        // Act
        $action->execute();
    }

    public function testExecute()
    {
        // Assert
        $callback = $this->getMockForAbstractClass(NodeInterface::class);
        $callback->expects($this->once())->method('execute');

        // Arrange
        $variableFile = new StringVariable();
        $variableFile->setValue(tempnam(sys_get_temp_dir(), 'test'));

        $variableMode = new StringVariable();
        $variableMode->setValue('w');

        $variableStream = new ResourceVariable();

        $action = new StreamOpenAction();
        $action->bind(StreamOpenAction::SOCKET_FILENAME, $variableFile);
        $action->bind(StreamOpenAction::SOCKET_MODE, $variableMode);
        $action->bind(StreamOpenAction::SOCKET_STREAM, $variableStream);
        $action->bind(StreamOpenAction::SOCKET_OUTPUT, $callback);

        // Act
        $action->execute();

        // Assert
        $this->assertInternalType('resource', $variableStream->getValue());
    }
}
