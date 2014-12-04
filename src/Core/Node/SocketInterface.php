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
 * The interface that represents a socket.
 */
interface SocketInterface
{
    /**
     * Activates this socket.
     */
    public function activate();

    /**
     * Adds a node to the connection list.
     *
     * @param NodeInterface $node The node to add.
     */
    public function addNode(NodeInterface $node);

    /**
     * Removes all the connections from this socket.
     *
     * @return Socket
     */
    public function clearNodes();

    /**
     * Gets the id of the node.
     *
     * @return string
     */
    public function getId();

    /**
     * Gets the name of the socket.
     *
     * @return string
     */
    public function getName();

    /**
     * Gets the node at the given index.
     *
     * @param int $index The index of the node to get.
     * @return NodeInterface
     */
    public function getNode($index);

    /**
     * Gets a list with all the connected nodes.
     *
     * @return NodeInterface[]
     */
    public function getNodes();

    /**
     * Checks if there are nodes bound to this socket.
     *
     * @return bool
     */
    public function hasNodes();

    /**
     * Checks if the socket is enabled.
     *
     * @return bool
     */
    public function isEnabled();

    /**
     * Removes the given node from the connections list.
     *
     * @param NodeInterface $node The node to remove.
     */
    public function removeNode(NodeInterface $node);

    /**
     * Enables or disables the socket.
     *
     * @param bool $enabled The flag to set.
     * @return Socket
     */
    public function setEnabled($enabled);

    /**
     * Sets the node on the given index.
     *
     * @param int $index The index in the list to set the node for.
     * @param NodeInterface $node The node to set.
     */
    public function setNode($index, NodeInterface $node);
}
