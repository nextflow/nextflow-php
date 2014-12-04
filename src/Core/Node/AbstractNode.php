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
 * The base class for all node types.
 */
abstract class AbstractNode implements NodeInterface
{
    /**
     * The id of the node.
     *
     * @var string
     */
    private $id;

    /**
     * The parameters of this node.
     *
     * @var array
     */
    private $parameters;

    /**
     * The sockets that this node has.
     *
     * @var Socket[]
     */
    private $sockets;

    /**
     * The value of this node.
     *
     * @var mixed
     */
    private $value;

    /**
     * Initializes a new instance of this class.
     */
    public function __construct()
    {
        $this->parameters = array();
        $this->sockets = array();
    }

    /**
     * Activates the socket with the given index.
     *
     * @param string $socket The name of the socket to activate.
     */
    protected function activate($socket)
    {
        $this->getSocket($socket)->activate();
    }

    /**
     * Binds the given node to a socket.
     *
     * @param string $socket The name of the socket to bind to.
     * @param NodeInterface $node The node to bind to.
     */
    public function bind($socket, NodeInterface $node)
    {
        $socket = $this->getSocket($socket);

        $socket->addNode($node);

        return $socket->getNodeCount() - 1;
    }

    /**
     * Creates a socket with the given name.
     *
     * @param string $name The name of the scoket to create.
     */
    protected function createSocket($name)
    {
        if (array_key_exists($name, $this->sockets)) {
            throw new \InvalidArgumentException('The socket "' . $name . '" already exists.');
        }

        $this->sockets[$name] = new Socket($name);
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
     * Gets the parameter with the given name.
     *
     * @param string $name The name of the parameter to get.
     * @return string
     */
    public function getParam($name)
    {
        if (array_key_exists($name, $this->parameters)) {
            return $this->parameters[$name];
        }
        return null;
    }

    /**
     * Gets the parameters of this node.
     *
     * @return array
     */
    public function getParams()
    {
        return $this->parameters;
    }

    /**
     * Gets the socket with the given index.
     *
     * @param string $name The name of the socket to get.
     * @return Socket
     */
    public function getSocket($name)
    {
        if (!$this->hasSocket($name)) {
            throw new \InvalidArgumentException('The socket "' . $name . '" does not exist.');
        }

        return $this->sockets[$name];
    }

    /**
     * Gets a list with all sockets that exist for this node.
     *
     * @return Socket[]
     */
    public function getSockets()
    {
        return $this->sockets;
    }

    /**
     * Gets the value of this node.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Checks if the node has a socket with the given name.
     *
     * @param string $name The name of the socket to check.
     * @return bool
     */
    public function hasSocket($name)
    {
        return array_key_exists($name, $this->sockets);
    }

    /**
     * Sets the parameter with the given name.
     *
     * @param string $name The name of the parameter to get.
     * @param mixed $value The value to set.
     */
    public function setParam($name, $value)
    {
        $this->parameters[$name] = $value;
    }

    /**
     * Sets the value of this node.
     *
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
