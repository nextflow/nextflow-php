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
 * An action that is able to write to a stream.
 */
final class StreamWriteAction extends AbstractAction
{
    /** The output socket. */
    const SOCKET_OUTPUT = 'out';

    /** The stream variable socket. */
    const SOCKET_STREAM = 'stream';

    /** The data variable socket. */
    const SOCKET_DATA = 'data';

    /**
     * Initializes a new instance of this class.
     */
    public function __construct()
    {
        parent::__construct();

        $this->createSocket(self::SOCKET_OUTPUT);
        $this->createSocket(self::SOCKET_STREAM);
        $this->createSocket(self::SOCKET_DATA);
    }

    /**
     * Executes the node's logic.
     */
    public function execute()
    {
        $streamSocket = $this->getSocket(self::SOCKET_STREAM);
        if (!$streamSocket || !$streamSocket->hasNodes()) {
            throw new InvalidArgumentException('No stream to write to.');
        }

        $dataSocket = $this->getSocket(self::SOCKET_DATA);
        if (!$dataSocket || !$dataSocket->hasNodes()) {
            throw new InvalidArgumentException('There is no data to write.');
        }

        $streamValue = $streamSocket->getNode(0)->getValue();
        $dataValue = $dataSocket->getNode(0)->getValue();

        fwrite($streamValue, $dataValue);

        $this->activate(self::SOCKET_OUTPUT);
    }
}
