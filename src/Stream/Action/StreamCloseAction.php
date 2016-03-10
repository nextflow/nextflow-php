<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Stream\Action;

use InvalidArgumentException;
use NextFlow\Core\Action\AbstractAction;

/**
 * Closes a stream.
 */
final class StreamCloseAction extends AbstractAction
{
    /** The output socket. */
    const SOCKET_OUTPUT = 'out';

    /** The stream variable socket. */
    const SOCKET_STREAM = 'stream';

    /**
     * Initializes a new instance of this class.
     */
    public function __construct()
    {
        parent::__construct();

        $this->createSocket(self::SOCKET_OUTPUT);
        $this->createSocket(self::SOCKET_STREAM);
    }

    /**
     * Executes the node's logic.
     */
    public function execute()
    {
        $socket = $this->getSocket(self::SOCKET_STREAM);
        if (!$socket || !$socket->hasNodes()) {
            throw new InvalidArgumentException('There is no stream to close.');
        }

        $streamValue = $socket->getNode(0)->getValue();
        if (!is_resource($streamValue)) {
            throw new InvalidArgumentException('Invalid stream provided.');
        }

        fclose($streamValue);

        $this->activate(self::SOCKET_OUTPUT);
    }
}
