<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Core\Serializer;

use NextFlow\Core\Event\NamedEvent;
use NextFlow\Core\Scene\Scene;
use NextFlow\Core\Serializer\JsonSerializer;
use NextFlow\Php\Action\EchoAction;
use PHPUnit_Framework_TestCase;

class JsonSerializerTest extends PHPUnit_Framework_TestCase
{
    public function testSerializeSingleEvent()
    {
        $event = new NamedEvent('dispatch');

        $scene = new Scene();
        $scene->addEvent($event);

        $serializer = new JsonSerializer();

        $this->assertStringEqualsFile(__DIR__ . '/TestAsset/scene-single-event.json', $serializer->serialize($scene));
    }

    public function testSerializeConnectedEvent()
    {
        $action = new EchoAction();

        $event = new NamedEvent('dispatch');
        $event->bind(NamedEvent::SOCKET_OUT, $action);

        $scene = new Scene();
        $scene->addEvent($event);

        $serializer = new JsonSerializer();

        $this->assertStringEqualsFile(__DIR__ . '/TestAsset/scene-connected-event.json', $serializer->serialize($scene));
    }

    public function testUnserializeSingleEvent()
    {
        $serializer = new JsonSerializer();
        $scene = $serializer->unserialize(file_get_contents(__DIR__ . '/TestAsset/scene-single-event.json'));

        // TODO
    }

    public function testUnserializeConnectedEvent()
    {
        $serializer = new JsonSerializer();
        $scene = $serializer->unserialize(file_get_contents(__DIR__ . '/TestAsset/scene-connected-event.json'));

        // TODO
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testUnserializeInvalidSceneUnknownClass()
    {
        $serializer = new JsonSerializer();
        $serializer->unserialize(file_get_contents(__DIR__ . '/TestAsset/invalid-scene-unknown-class.json'));
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage The class NextFlowTest\Core\Serializer\TestAsset\DummyScene should implement SceneInterface.
     */
    public function testUnserializeInvalidSceneWrongImplementation()
    {
        $serializer = new JsonSerializer();
        $serializer->unserialize(file_get_contents(__DIR__ . '/TestAsset/invalid-scene-class.json'));
    }
}
