<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Core\Event;

use NextFlow\Core\Event\NamedEvent;

class NamedEventTest extends \PHPUnit_Framework_TestCase
{
    public function testNullName()
    {
        // Arrange
        $event = new NamedEvent(null);

        // Act
        // ...

        // Assert
        $this->assertNull($event->getName());
    }

    public function testSettingAndGetting()
    {
        // Arrange
        $event = new NamedEvent('test');

        // Act
        // ...

        // Assert
        $this->assertSame('test', $event->getName());
    }
}
