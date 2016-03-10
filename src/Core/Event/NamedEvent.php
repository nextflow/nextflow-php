<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Core\Event;

/**
 * A simple implementation of an event with a name.
 */
final class NamedEvent extends AbstractEvent
{
    /** The output socket. */
    const SOCKET_OUT = 'out';

    /**
     * Initializes a new instance of this class.
     */
    public function __construct($name)
    {
        parent::__construct();

        $this->createSocket(self::SOCKET_OUT);

        $this->setParam('name', $name);
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
}
