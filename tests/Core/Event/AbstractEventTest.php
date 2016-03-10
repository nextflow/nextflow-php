<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Core\Event;

use NextFlowTest\Core\Event\TestAsset\Dummy;
use PHPUnit_Framework_TestCase;

class AbstractEventTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        // Arrange
        $event = new Dummy();

        // Act
        $event->execute();

        // Assert
        $this->assertSame('NextFlowTest\Core\Event\TestAsset\Dummy', $event->getName());
    }
}
