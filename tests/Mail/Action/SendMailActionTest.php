<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Mail\Action;

use NextFlow\Core\Node\NodeInterface;
use NextFlow\Mail\Action\SendMailAction;
use NextFlow\Mail\Transport\TransportInterface;
use NextFlow\Php\Variable\StringVariable;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

class SendMailActionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $transport;

    protected function setUp()
    {
        parent::setUp();

        $builder = $this->getMockBuilder(TransportInterface::class);

        $this->transport = $builder->getMockForAbstractClass();
    }

    private function createStringVariable($value)
    {
        $variable = new StringVariable();
        $variable->setValue($value);

        return $variable;
    }

    public function testSocketCreation()
    {
        // Arrange
        $action = new SendMailAction($this->transport);

        // Act
        // ...

        // Assert
        $this->assertCount(6, $action->getSockets());
        $this->assertNotNull($action->getSocket(SendMailAction::SOCKET_FROM));
        $this->assertNotNull($action->getSocket(SendMailAction::SOCKET_MESSAGE));
        $this->assertNotNull($action->getSocket(SendMailAction::SOCKET_OUTPUT_ERROR));
        $this->assertNotNull($action->getSocket(SendMailAction::SOCKET_OUTPUT_SUCCESS));
        $this->assertNotNull($action->getSocket(SendMailAction::SOCKET_SUBJECT));
        $this->assertNotNull($action->getSocket(SendMailAction::SOCKET_TO));
    }

    public function testExecuteWithoutTo()
    {
        // Assert
        $this->setExpectedException('RuntimeException', 'The socket "to" has no nodes.');

        // Arrange
        $action = new SendMailAction($this->transport);

        // Act
        $action->execute();
    }

    public function testExecuteWithoutToValue()
    {
        // Assert
        $this->setExpectedException('InvalidArgumentException', 'No address to send an e-mail to.');

        // Arrange
        $action = new SendMailAction($this->transport);
        $action->bind(SendMailAction::SOCKET_TO, $this->createStringVariable(null));

        // Act
        $action->execute();
    }

    public function testExecuteWithoutSubject()
    {
        // Assert
        $this->setExpectedException('RuntimeException', 'The socket "subject" has no nodes.');

        // Arrange
        $action = new SendMailAction($this->transport);
        $action->bind(SendMailAction::SOCKET_TO, $this->createStringVariable('test'));

        // Act
        $action->execute();
    }

    public function testExecuteWithoutSubjectValue()
    {
        // Assert
        $this->setExpectedException('InvalidArgumentException', 'There is no subject set.');

        // Arrange
        $action = new SendMailAction($this->transport);
        $action->bind(SendMailAction::SOCKET_TO, $this->createStringVariable('test'));
        $action->bind(SendMailAction::SOCKET_SUBJECT, $this->createStringVariable(null));

        // Act
        $action->execute();
    }

    public function testExecuteWithoutMessage()
    {
        // Assert
        $this->setExpectedException('RuntimeException', 'The socket "message" has no nodes.');

        // Arrange
        $action = new SendMailAction($this->transport);
        $action->bind(SendMailAction::SOCKET_TO, $this->createStringVariable('test'));
        $action->bind(SendMailAction::SOCKET_SUBJECT, $this->createStringVariable('test'));

        // Act
        $action->execute();
    }

    public function testExecuteWithoutMessageValue()
    {
        // Assert
        $this->setExpectedException('InvalidArgumentException', 'There is no message to send.');

        // Arrange
        $action = new SendMailAction($this->transport);
        $action->bind(SendMailAction::SOCKET_TO, $this->createStringVariable('test'));
        $action->bind(SendMailAction::SOCKET_SUBJECT, $this->createStringVariable('test'));
        $action->bind(SendMailAction::SOCKET_MESSAGE, $this->createStringVariable(null));

        // Act
        $action->execute();
    }

    public function testExecuteWithoutFrom()
    {
        // Assert
        $this->setExpectedException('RuntimeException', 'The socket "from" has no nodes.');

        // Arrange
        $action = new SendMailAction($this->transport);
        $action->bind(SendMailAction::SOCKET_TO, $this->createStringVariable('test'));
        $action->bind(SendMailAction::SOCKET_SUBJECT, $this->createStringVariable('test'));
        $action->bind(SendMailAction::SOCKET_MESSAGE, $this->createStringVariable('test'));

        // Act
        $action->execute();
    }

    public function testExecuteWithoutFromValue()
    {
        // Assert
        $this->setExpectedException('InvalidArgumentException', 'There is no from address set.');

        // Arrange
        $action = new SendMailAction($this->transport);
        $action->bind(SendMailAction::SOCKET_TO, $this->createStringVariable('test'));
        $action->bind(SendMailAction::SOCKET_SUBJECT, $this->createStringVariable('test'));
        $action->bind(SendMailAction::SOCKET_MESSAGE, $this->createStringVariable('test'));
        $action->bind(SendMailAction::SOCKET_FROM, $this->createStringVariable(null));

        // Act
        $action->execute();
    }

    public function testExecuteSuccess()
    {
        // Assert
        $this->transport->expects($this->once())->method('send')->willReturn(true);

        $callbackNode = $this->getMockForAbstractClass(NodeInterface::class);
        $callbackNode->expects($this->once())->method('execute');

        // Arrange
        $action = new SendMailAction($this->transport);
        $action->bind(SendMailAction::SOCKET_TO, $this->createStringVariable('test'));
        $action->bind(SendMailAction::SOCKET_SUBJECT, $this->createStringVariable('test'));
        $action->bind(SendMailAction::SOCKET_MESSAGE, $this->createStringVariable('test'));
        $action->bind(SendMailAction::SOCKET_FROM, $this->createStringVariable('test'));
        $action->bind(SendMailAction::SOCKET_OUTPUT_SUCCESS, $callbackNode);

        // Act
        $action->execute();
    }

    public function testExecuteError()
    {
        // Assert
        $this->transport->expects($this->once())->method('send')->willReturn(false);

        $callbackNode = $this->getMockForAbstractClass(NodeInterface::class);
        $callbackNode->expects($this->once())->method('execute');

        // Arrange
        $action = new SendMailAction($this->transport);
        $action->bind(SendMailAction::SOCKET_TO, $this->createStringVariable('test'));
        $action->bind(SendMailAction::SOCKET_SUBJECT, $this->createStringVariable('test'));
        $action->bind(SendMailAction::SOCKET_MESSAGE, $this->createStringVariable('test'));
        $action->bind(SendMailAction::SOCKET_FROM, $this->createStringVariable('test'));
        $action->bind(SendMailAction::SOCKET_OUTPUT_ERROR, $callbackNode);

        // Act
        $action->execute();
    }
}
