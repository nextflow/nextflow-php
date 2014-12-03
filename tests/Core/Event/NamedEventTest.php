<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Core\Event;

use NextFlow\Core\Event\NamedEvent;

class NamedEventTest extends \PHPUnit_Framework_TestCase
{
    public function testNullName()
    {
        $event = new NamedEvent();

        $this->assertNull($event->getName());
    }

    public function testSettingAndGetting()
    {
        $event = new NamedEvent();
        $this->assertNull($event->getName());

        $event->setName('test');
        $this->assertSame('test', $event->getName());
    }
}
