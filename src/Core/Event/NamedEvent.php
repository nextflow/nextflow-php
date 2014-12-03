<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Core\Event;

/**
 * A simple implementation of an event with a name.
 */
class NamedEvent extends AbstractEvent
{
    /** The output socket. */
    const SOCKET_OUT = 'out';

    /**
     * Initializes a new instance of this class.
     */
    public function __construct()
    {
        parent::__construct();

        $this->createSocket(self::SOCKET_OUT);
    }

    /**
     * Executes the node's logic.
     *
     * @return NodeInterface
     */
    public function execute()
    {
        $this->activate(self::SOCKET_OUT);
    }

    /**
     * Gets the name of the event.
     *
     * @return string
     */
    public function getName()
    {
        return $this->getParam('name');
    }

    /**
     * Sets the name of the event.
     *
     * @param string $name The name to set.
     */
    public function setName($name)
    {
        $this->setParam('name', $name);
    }
}
