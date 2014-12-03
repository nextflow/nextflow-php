<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Core\Scene;

use NextFlow\Core\Event\NamedEvent;
use NextFlow\Core\Scene\Scene;

class SceneTest extends \PHPUnit_Framework_TestCase
{
    public function testAddEvent()
    {
        $event = new NamedEvent('event');

        $scene = new Scene();
        $scene->addEvent($event);

        $this->assertCount(1, $scene->getEvents());
    }

    public function testAddEventTwice()
    {
        $event = new NamedEvent('event');
        $scene = new Scene();

        $scene->addEvent($event);
        $this->assertCount(1, $scene->getEvents());

        $scene->addEvent($event);
        $this->assertCount(1, $scene->getEvents());
    }

    public function testClearEvents()
    {
        $event = new NamedEvent('event');
        $scene = new Scene();

        $scene->addEvent($event);
        $this->assertCount(1, $scene->getEvents());

        $scene->clearEvents();

        $this->assertCount(0, $scene->getEvents());
    }

    public function testGetEvents()
    {
        $event = new NamedEvent('event');

        $scene = new Scene();
        $scene->addEvent($event);

        $this->assertEquals(array($event), $scene->getEvents());
    }

    public function testSetName()
    {
        $scene = new Scene();

        $scene->setName('');
        $this->assertSame('', $scene->getName());

        $scene->setName(null);
        $this->assertSame('', $scene->getName());

        $scene->setName('Hello');
        $this->assertSame('Hello', $scene->getName());
    }

    public function testRemoveEvent()
    {
        $event = new NamedEvent('event');
        $scene = new Scene();

        $scene->addEvent($event);
        $this->assertCount(1, $scene->getEvents());

        $scene->removeEvent($event);

        $this->assertCount(0, $scene->getEvents());
    }

    public function testExecute()
    {
        $event = new NamedEvent();
        $event->setName('event');
        $scene = new Scene();

        $scene->addEvent($event);
        $scene->addEvent($event);
        $this->assertEquals(1, $scene->execute('event'));
    }

    public function testExecuteUnknownEvent()
    {
        $scene = new Scene();
        $this->assertEquals(0, $scene->execute('UnknownEvent'));
    }
}
