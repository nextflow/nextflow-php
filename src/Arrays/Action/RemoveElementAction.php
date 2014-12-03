<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Arrays\Action;

use NextFlow\Core\Action\AbstractAction;

/**
 * Removes an element from the array.
 */
class RemoveElementAction extends AbstractAction
{
    /** The output action socket. */
    const SOCKET_OUTPUT = 'out';

    /** The array variable socket. */
    const SOCKET_ARRAY = 'array';

    /** The element variable socket. */
    const SOCKET_ELEMENT = 'element';

    /**
     * Initializes a new instance of this class.
     */
    public function __construct()
    {
        parent::__construct();

        $this->createSocket(self::SOCKET_OUTPUT);
        $this->createSocket(self::SOCKET_ARRAY);
        $this->createSocket(self::SOCKET_ELEMENT);
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

        $element = $this->getSocket(self::SOCKET_ELEMENT)->getNode(0);
        if ($element === null || $element->getValue() === null) {
            throw new \InvalidArgumentException('No element variable provided.');
        }

        $newArray = array_diff($array->getValue(), array($element->getValue()));
        $array->setValue($newArray);

        $this->activate(self::SOCKET_OUTPUT);
    }
}
