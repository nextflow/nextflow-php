<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Stream\Action;

use NextFlow\Core\Action\AbstractAction;

/**
 * Opens a stream.
 */
class StreamOpenAction extends AbstractAction
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
        $fileNameValue = $this->getSocket(self::SOCKET_FILENAME)->getNode(0)->getValue();
        if ($fileNameValue === null) {
            throw new \InvalidArgumentException('There is no filename provided.');
        }

        $modeValue = $this->getSocket(self::SOCKET_MODE)->getNode(0)->getValue();
        if ($modeValue === null) {
            throw new \InvalidArgumentException('There is stream mode provided.');
        }

        $resource = fopen($fileNameValue, $modeValue);
        $this->getSocket(self::SOCKET_STREAM)->getNode(0)->setValue($resource);

        $this->activate(self::SOCKET_OUTPUT);
    }
}
