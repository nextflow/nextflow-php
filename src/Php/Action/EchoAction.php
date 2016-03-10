<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Php\Action;

use NextFlow\Core\Action\AbstractAction;

/**
 * An action that simply echo's data.
 */
final class EchoAction extends AbstractAction
{
    /** The constant that defines the output socket. */
    const SOCKET_OUTPUT = 'out';

    /** The socket that holds the data variable. */
    const SOCKET_DATA = 'data';

    /**
     * Initializes a new instance of this class.
     */
    public function __construct()
    {
        parent::__construct();

        $this->createSocket(self::SOCKET_OUTPUT);
        $this->createSocket(self::SOCKET_DATA);
    }

    /**
     * Executes the node's logic.
     */
    public function execute()
    {
        $node = $this->getSocket(self::SOCKET_DATA)->getNode(0);
        if ($node === null || $node->getValue() === null) {
            throw new \InvalidArgumentException('There is no data set.');
        }

        echo $node->getValue();

        $this->activate(self::SOCKET_OUTPUT);
    }
}
