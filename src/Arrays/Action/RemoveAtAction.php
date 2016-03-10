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

/**
 * Removes the element at a certain position.
 */
final class RemoveAtAction extends AbstractAction
{
    /** The output action socket. */
    const SOCKET_OUTPUT = 'out';

    /** The array variable socket. */
    const SOCKET_ARRAY = 'array';

    /** The index variable socket. */
    const SOCKET_INDEX = 'index';

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
        $this->createSocket(self::SOCKET_INDEX);
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

        $index = $this->getSocket(self::SOCKET_INDEX)->getNode(0);
        if ($index === null || $index->getValue() === null) {
            throw new \InvalidArgumentException('No index variable provided.');
        }

        // It could be that the array is an associative array. Therefor we cannot simply remove it by index, we
        // have to count up the index and than check the key. That key is used to remove the value.

        $arrayValue = $array->getValue();

        for ($i = 0; $i < $index->getValue(); ++$i) {
            next($arrayValue);
        }

        $removedValue = current($arrayValue);
        unset($arrayValue[key($arrayValue)]);

        $data = $this->getSocket(self::SOCKET_DATA);
        if ($data->hasNodes()) {
            $data->getNode(0)->setValue($removedValue);
        }

        $array->setValue($arrayValue);
        $this->activate(self::SOCKET_OUTPUT);
    }
}
