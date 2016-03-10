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
 * Opens a stream.
 */
final class StreamOpenAction extends AbstractAction
{
    /** The output socket. */
    const SOCKET_OUTPUT = 'out';

    /** The filename variable socket. */
    const SOCKET_FILENAME = 'filename';

    /** The mode variable socket. */
    const SOCKET_MODE = 'mode';

    /** The stream variable socket. */
    const SOCKET_STREAM = 'stream';

    /**
     * Initializes a new instance of this class.
     */
    public function __construct()
    {
        parent::__construct();

        $this->createSocket(self::SOCKET_OUTPUT);
        $this->createSocket(self::SOCKET_FILENAME);
        $this->createSocket(self::SOCKET_MODE);
        $this->createSocket(self::SOCKET_STREAM);
    }

    /**
     * Executes the node's logic.
     */
    public function execute()
    {
        $fileNameSocket = $this->getSocket(self::SOCKET_FILENAME);
        if (!$fileNameSocket || !$fileNameSocket->hasNodes()) {
            throw new InvalidArgumentException('There is no filename provided.');
        }

        $modeSocket = $this->getSocket(self::SOCKET_MODE);
        if (!$modeSocket || !$modeSocket->hasNodes()) {
            throw new InvalidArgumentException('There is no stream mode provided.');
        }

        $resourceSocket = $this->getSocket(self::SOCKET_STREAM);
        if (!$resourceSocket || !$resourceSocket->hasNodes()) {
            throw new InvalidArgumentException('There is no stream variable provided.');
        }

        $fileNameValue = $fileNameSocket->getNode(0)->getValue();
        $modeValue = $modeSocket->getNode(0)->getValue();

        $resource = fopen($fileNameValue, $modeValue);
        $resourceSocket->getNode(0)->setValue($resource);

        $this->activate(self::SOCKET_OUTPUT);
    }
}
