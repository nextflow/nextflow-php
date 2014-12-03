<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Core\Node;

use NextFlow\Core\Node\Socket;

class SocketTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $socket = new Socket('name');

        $this->assertSame('name', $socket->getName());
        $this->assertTrue($socket->isEnabled());
        $this->assertSame(0, $socket->getNodeCount());
    }

    public function testActivate()
    {
        // TODO, mock a class?
    }

    public function testAddNode()
    {
        $socket = new Socket('name');
        $this->assertFalse($socket->hasNodes());

        $socket->addNode(new \NextFlow\Php\Action\EchoAction());
        $this->assertTrue($socket->hasNodes());

        $this->assertInstanceOf('NextFlow\Php\Action\EchoAction', $socket->getNode(0));
    }

    public function testClearNodes()
    {
        $socket = new Socket('name');
        $this->assertCount(0, $socket->getNodes());

        $socket->addNode(new \NextFlow\Php\Action\EchoAction());
        $socket->addNode(new \NextFlow\Php\Action\EchoAction());
        $socket->addNode(new \NextFlow\Php\Action\EchoAction());
        $this->assertCount(3, $socket->getNodes());

        $socket->clearNodes();
        $this->assertCount(0, $socket->getNodes());
    }

    public function testGetId()
    {
        $socket = new Socket('name');

        $objectHash = spl_object_hash($socket);

        $this->assertSame($objectHash, $socket->getId());
    }

    public function testGetName()
    {
        $socket = new Socket('name');

        $this->assertSame('name', $socket->getName());
    }

    public function testGetNodes()
    {
        $socket = new Socket('name');
        $this->assertCount(0, $socket->getNodes());

        $socket->addNode(new \NextFlow\Php\Action\EchoAction());
        $socket->addNode(new \NextFlow\Php\Action\EchoAction());
        $socket->addNode(new \NextFlow\Php\Action\EchoAction());

        $this->assertCount(3, $socket->getNodes());
    }

    public function testHasNodes()
    {
        $socket = new Socket('name');
        $this->assertFalse($socket->hasNodes());

        $socket->addNode(new \NextFlow\Php\Action\EchoAction());
        $this->assertTrue($socket->hasNodes());
    }

    public function testRemoveNode()
    {
        $socket = new Socket('name');
        $this->assertCount(0, $socket->getNodes());

        $node1 = new \NextFlow\Php\Action\EchoAction();
        $node2 = new \NextFlow\Php\Action\VarDumpAction();

        $socket->addNode($node1);
        $socket->addNode($node2);
        $this->assertCount(2, $socket->getNodes());

        $socket->removeNode($node1);
        $this->assertCount(1, $socket->getNodes());
        $this->assertEquals($node2, $socket->getNode(0));
    }

    public function testSetEnabled()
    {
        $socket = new Socket('name');
        $this->assertTrue($socket->isEnabled());

        $socket->setEnabled(false);
        $this->assertFalse($socket->isEnabled());

        $socket->setEnabled(true);
        $this->assertTrue($socket->isEnabled());
    }

    public function testSetNode()
    {
        $socket = new Socket('name');
        $this->assertCount(0, $socket->getNodes());

        $node1 = new \NextFlow\Php\Action\EchoAction();
        $node2 = new \NextFlow\Php\Action\VarDumpAction();

        $socket->addNode($node1);
        $this->assertCount(1, $socket->getNodes());
        $this->assertEquals($node1, $socket->getNode(0));

        $socket->setNode(0, $node2);
        $this->assertCount(1, $socket->getNodes());
        $this->assertEquals($node2, $socket->getNode(0));
    }
}
