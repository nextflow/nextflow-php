<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Core\Scene;

use NextFlow\Core\Event\NamedEvent;
use NextFlow\Core\Scene\Scene;

class SceneTest extends \PHPUnit_Framework_TestCase
{
    public function testAddEvent()
    {
        // Arrange
        $event = new NamedEvent('event');
        $scene = new Scene();

        // Act
        $scene->addEvent($event);

        // Assert
        $this->assertCount(1, $scene->getEvents());
    }

    public function testAddEventTwice()
    {
        // Arrange
        $event = new NamedEvent('event');
        $scene = new Scene();

        // Act
        $scene->addEvent($event);
        $scene->addEvent($event);

        // Assert
        $this->assertCount(1, $scene->getEvents());
    }

    public function testClearEvents()
    {
        // Arrange
        $event = new NamedEvent('event');
        $scene = new Scene();

        $scene->addEvent($event);
        $this->assertCount(1, $scene->getEvents());

        // Act
        $scene->clearEvents();

        // Assert
        $this->assertCount(0, $scene->getEvents());
    }

    public function testGetEvents()
    {
        // Arrange
        $event = new NamedEvent('event');

        $scene = new Scene();
        $scene->addEvent($event);

        // Act
        $result = $scene->getEvents();

        // Assert
        $this->assertEquals(array($event), $result);
    }

    public function testSetName()
    {
        // Arrange
        $scene = new Scene();

        // Act
        $scene->setName('Hello');

        // Assert
        $this->assertSame('Hello', $scene->getName());
    }

    public function testRemoveEvent()
    {
        // Arrange
        $event = new NamedEvent('event');

        $scene = new Scene();
        $scene->addEvent($event);

        // Act
        $scene->removeEvent($event);

        // Assert
        $this->assertCount(0, $scene->getEvents());
    }

    public function testExecute()
    {
        // Arrange
        $event = new NamedEvent('event');
        $scene = new Scene();
        $scene->addEvent($event);
        $scene->addEvent($event);

        // Act
        $result = $scene->execute('event');

        // Assert
        $this->assertEquals(1, $result);
    }

    public function testExecuteUnknownEvent()
    {
        // Arrange
        $scene = new Scene();

        // Act
        $result = $scene->execute('UnknownEvent');

        // Assert
        $this->assertEquals(0, $result);
    }
}
