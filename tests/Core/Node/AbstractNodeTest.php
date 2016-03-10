<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Core\Node;

use NextFlow\Php\Action\VarDumpAction;
use NextFlowTest\Core\Node\TestAsset\DuplicateSocketDummy;
use PHPUnit_Framework_TestCase;

class AbstractNodeTest extends PHPUnit_Framework_TestCase
{
    public function testGetParams()
    {
        $node = new VarDumpAction();
        $node->setParam('param1', '123');
        $node->setParam('param2', '456');

        $this->assertCount(2, $node->getParams());
        $this->assertEquals(array(
            'param1' => '123',
            'param2' => '456'
        ), $node->getParams());
    }

    public function testGetNonExistingParam()
    {
        // Arrange
        $node = new VarDumpAction();

        // Act
        $result = $node->getParam('whattttt');

        // Assert
        $this->assertNull($result);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testDuplicateSocket()
    {
        new DuplicateSocketDummy();
    }

    public function testGetId()
    {
        $node = new VarDumpAction();

        $objectHash = spl_object_hash($node);

        $this->assertSame($objectHash, $node->getId());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetInvalidSocket()
    {
        $node = new VarDumpAction();
        $node->getSocket('unknown');
    }
}
