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
 * Inserts a value into an array.
 */
final class InsertAction extends AbstractAction
{
    /** The output action socket. */
    const SOCKET_OUTPUT = 'out';

    /** The array variable socket. */
    const SOCKET_ARRAY = 'array';

    /** The index variable socket. */
    const SOCKET_INDEX = 'index';

    /** The value variable socket. */
    const SOCKET_VALUE = 'value';

    /**
     * Initializes a new instance of this class.
     */
    public function __construct()
    {
        parent::__construct();

        $this->createSocket(self::SOCKET_OUTPUT);
        $this->createSocket(self::SOCKET_ARRAY);
        $this->createSocket(self::SOCKET_INDEX);
        $this->createSocket(self::SOCKET_VALUE);
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

        $value = $this->getSocket(self::SOCKET_VALUE)->getNode(0);
        if ($value === null || $value->getValue() === null) {
            throw new \InvalidArgumentException('No value variable provided.');
        }

        $arrayValue = $array->getValue();
        array_splice($arrayValue, $index->getValue(), 0, $value->getValue());
        $array->setValue($arrayValue);

        $this->activate(self::SOCKET_OUTPUT);
    }
}
