<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Arrays\Action;

use NextFlow\Core\Action\AbstractAction;
use NextFlow\Core\Node\NodeInterface;

/**
 * A base final class for push actions.
 */
abstract class AbstractPushAction extends AbstractAction
{
    /** The output action socket. */
    const SOCKET_OUTPUT = 'out';

    /** The array variable socket. */
    const SOCKET_ARRAY = 'array';

    /** The data variable socket. */
    const SOCKET_DATA = 'data';

    /**
     * Initializes a new instance of this class.
     */
    public function __construct()
    {
        parent::__construct();

        $this->createSocket(self::SOCKET_OUTPUT);
        $this->createSocket(self::SOCKET_ARRAY);
        $this->createSocket(self::SOCKET_DATA);
    }

    /**
     * Executes the node's logic.
     */
    public function execute()
    {
        $array = $this->getSocket(self::SOCKET_ARRAY)->getNode(0);
        if ($array === null) {
            throw new \InvalidArgumentException('No array variable provided.');
        }

        $data = $this->getSocket(self::SOCKET_DATA)->getNode(0);
        if ($data === null) {
            throw new \InvalidArgumentException('No array variable provided.');
        }

        $this->executePush($array, $data->getValue());

        $this->activate(self::SOCKET_OUTPUT);
    }

    /**
     * Executes the push logic.
     *
     * @param NodeInterface $node The node to push data to.
     * @param mixed $value The value to push.
     */
    abstract protected function executePush(NodeInterface $node, $value);
}
