<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Core\Serializer;

use NextFlow\Core\Scene\SceneInterface;

/**
 * A serializer that serializes or unserializes a scene to JSON.
 */
class JsonSerializer implements SerializerInterface
{
    /**
     * A map with id's that are serialized so we don't serialize a node twice.
     *
     * @var array
     */
    private $cachedIds;

    /**
     * A map with nodes that are serialized so we don't serialize a node twice.
     *
     * @var array
     */
    private $cachedNodes;

    /**
     * Initializes a new instance of this class.
     */
    public function __construct()
    {
        $this->resetCache();
    }

    /**
     * Serializes the given scene.
     *
     * @param $scene The scene to serialize.
     * @return string
     */
    public function serialize(SceneInterface $scene)
    {
        $this->resetCache();
        $this->cacheNodes($scene->getEvents());

        $data = array();
        $data['type'] = get_class($scene);
        $data['name'] = $scene->getName();
        $data['nodes'] = new \stdClass();

        $nodeIndex = 0;
        foreach ($this->cachedNodes as $id => $node) {
            $nodeSockets = new \stdClass();
            foreach ($node->getSockets() as $socketName => $socket) {
                $nodes = array();
                foreach ($socket->getNodes() as $connectedNode) {
                    $nodes[] = $this->cachedIds[$connectedNode->getId()];
                }
                $nodeSockets->$socketName = $nodes;
            }

            $data['nodes']->$nodeIndex = array(
                'type' => get_class($node),
                'parameters' => $node->getParams(),
                'sockets' => $nodeSockets,
            );
            $nodeIndex++;
        }


        $data['events'] = array();
        foreach ($scene->getEvents() as $event) {
            $data['events'][] = $this->cachedIds[$event->getId()];
        }

        return json_encode($data);
    }

    /**
     * Unserializes the given data.
     *
     * @param string $data The data to unserialize.
     * @return SceneInterface
     */
    public function unserialize($data)
    {
        $this->resetCache();
        $json = json_decode($data);

        $scene = null;

        if (isset($json->type)) {
            $sceneClass = $json->type;

            $scene = new $sceneClass();
            $scene->setName($json->name);

            foreach ($json->nodes as $nodeId => $nodeJson) {
                $this->unserializeNode($nodeId, $nodeJson);
            }

            foreach ($json->nodes as $nodeId => $nodeJson) {
                $this->unserializeConnections($nodeId, (array)$nodeJson->sockets);
            }

            foreach ($json->events as $eventId) {
                $event = $this->cachedNodes[$eventId];

                $scene->addEvent($event);
            }
        }

        $this->resetCache();

        return $scene;
    }

    /**
     * Unserializes a node.
     *
     * @param string $id The id of the node.
     * @param array $json The json value to unserialize.
     */
    private function unserializeNode($id, $json)
    {
        $type = $json->type;

        $instance = new $type();

        foreach ($json->parameters as $name => $value) {
            $instance->setParam($name, $value);
        }

        $this->cachedNodes[] = $instance;
    }

    /**
     * Unserializes the connections of the node with the given id.
     *
     * @param string $id The id of the node.
     * @param array $sockets The sockets to unserialize.
     */
    private function unserializeConnections($id, array $sockets)
    {
        foreach ($sockets as $socket => $nodes) {
            foreach ($nodes as $nodeId) {
                $connectedNode = $this->cachedNodes[$nodeId];

                $this->cachedNodes[$id]->bind($socket, $connectedNode);
            }
        }
    }

    /**
     * Resets the internal cache.
     */
    private function resetCache()
    {
        $this->cachedIds = array();
        $this->cachedNodes = array();
    }

    /**
     * Caches the given list with nodes.
     *
     * @param array $nodes A list with nodes to cache.
     */
    private function cacheNodes($nodes)
    {
        foreach ($nodes as $node) {
            if (array_key_exists($node->getId(), $this->cachedIds)) {
                continue;
            }

            $this->cachedIds[$node->getId()] = count($this->cachedIds);
            $this->cachedNodes[] = $node;

            foreach ($node->getSockets() as $socket) {
                $this->cacheNodes($socket->getNodes());
            }
        }
    }
}
