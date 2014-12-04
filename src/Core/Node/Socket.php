<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Core\Node;

/**
 * The representation of a socket on a node.
 */
class Socket implements SocketInterface
{
    /**
     * The id of the socket.
     *
     * @var string
     */
    private $id;

    /**
     * Whether or not the socket is enabled.
     *
     * @var bool
     */
    private $enabled;

    /**
     * The name of the socket.
     *
     * @var string
     */
    private $name;

    /**
     * The nodes that are connected to this socket.
     *
     * @var NodeInterface[]
     */
    private $nodes;

    /**
     * Initializes a new instance of this class.
     *
     * @param string $name The name of the socket.
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->enabled = true;
        $this->nodes = array();
    }

    /**
     * Activates this socket.
     */
    public function activate()
    {
        if ($this->isEnabled()) {
            foreach ($this->nodes as $node) {
                $node->execute();
            }
        }
    }

    /**
     * Adds a node to the connection list.
     *
     * @param NodeInterface $node The node to add.
     */
    public function addNode(NodeInterface $node)
    {
        $this->nodes[] = $node;
    }

    /**
     * Removes all the connections from this socket.
     */
    public function clearNodes()
    {
        $this->nodes = array();
    }

    /**
     * Gets the id of the node.
     *
     * @return string
     */
    public function getId()
    {
        if ($this->id === null) {
            $this->id = spl_object_hash($this);
        }
        return $this->id;
    }

    /**
     * Gets the name of the socket.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the node at the given index.
     *
     * @param int $index The index of the node to get.
     * @return NodeInterface
     */
    public function getNode($index)
    {
        if (!array_key_exists($index, $this->nodes)) {
            return null;
        }

        return $this->nodes[$index];
    }

    /**
     * Gets the amount of nodes that this socket has.
     *
     * @return int
     */
    public function getNodeCount()
    {
        return count($this->nodes);
    }

    /**
     * Gets a list with all the connected nodes.
     *
     * @return NodeInterface[]
     */
    public function getNodes()
    {
        return $this->nodes;
    }

    /**
     * Checks if there are nodes bound to this socket.
     *
     * @return bool
     */
    public function hasNodes()
    {
        return count($this->nodes) != 0;
    }

    /**
     * Checks if the socket is enabled.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Removes the given node from the connections list.
     *
     * @param NodeInterface $node The node to remove.
     */
    public function removeNode(NodeInterface $node)
    {
        foreach ($this->nodes as $k => $temp) {
            if ($temp == $node) {
                unset($this->nodes[$k]);
                break;
            }
        }

        // Reinitialize the indices:
        $this->nodes = array_values($this->nodes);

        return $this;
    }

    /**
     * Enables or disables the socket.
     *
     * @param bool $enabled The flag to set.
     * @return Socket
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * Sets the node on the given index.
     *
     * @param int $index The index in the list to set the node for.
     * @param NodeInterface $node The node to set.
     */
    public function setNode($index, NodeInterface $node)
    {
        $this->nodes[$index] = $node;
    }
}
