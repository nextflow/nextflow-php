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
 * The interface that should be implemented by all nodes.
 */
interface NodeInterface
{
    /**
     * Binds the given node to a socket.
     *
     * @param string $socket The name of the socket to bind to.
     * @param NodeInterface $node The node to bind to.
     * @return Returns the index of the node on the socket.
     */
    public function bind($socket, NodeInterface $node);

    /**
     * Executes the node's logic.
     */
    public function execute();

    /**
     * Gets the id of the node.
     *
     * @return string
     */
    public function getId();

    /**
     * Gets the parameter with the given name.
     *
     * @param string $name The name of the parameter to get.
     * @return string
     */
    public function getParam($name);

    /**
     * Gets the parameters of this node.
     *
     * @return array
     */
    public function getParams();

    /**
     * Gets the value of this node.
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Gets the socket with the given index.
     *
     * @param string $name The name of the socket to get.
     * @return Socket
     */
    public function getSocket($index);

    /**
     * Gets a list with all sockets that exist for this node.
     *
     * @return Socket[]
     */
    public function getSockets();

    /**
     * Checks if the node has a socket with the given name.
     *
     * @param string $name The name of the socket to check.
     * @return bool
     */
    public function hasSocket($name);

    /**
     * Sets the parameter with the given name.
     *
     * @param string $name The name of the parameter to get.
     * @param mixed $value The value to set.
     */
    public function setParam($name, $value);

    /**
     * Sets the value of this node.
     *
     * @param mixed $value
     */
    public function setValue($value);
}
