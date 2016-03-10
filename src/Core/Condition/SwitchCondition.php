<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Core\Condition;

use NextFlow\Core\Action\AbstractAction;
use NextFlow\Core\Node\NodeInterface;

/**
 * A condition that is able to switch between multiple values.
 */
final class SwitchCondition extends AbstractAction
{
    /** The socket that connects the value variable. */
    const SOCKET_VALUE = 'value';

    /**
     * Initializes a new instance of this class.
     */
    public function __construct()
    {
        parent::__construct();

        $this->createSocket(self::SOCKET_VALUE);
    }

    /**
     * Binds the given node to a socket.
     *
     * @param string $socket The name of the socket to bind to.
     * @param NodeInterface $node The node to bind to.
     */
    public function bind($socket, NodeInterface $node)
    {
        if ($socket != self::SOCKET_VALUE && !$this->hasSocket($socket)) {
            $this->createSocket($socket);
        }

        parent::bind($socket, $node);
    }

    /**
     * Executes the node's logic.
     */
    public function execute()
    {
        $value = $this->getSocket(self::SOCKET_VALUE)->getNode(0)->getValue();

        if ($this->hasSocket($value)) {
            $this->activate($value);
        }
    }
}
