<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Math\Action;

use NextFlow\Core\Action\AbstractAction as BaseAbstractAction;

/**
 * The base class for simple math actions.
 */
abstract class AbstractAction extends BaseAbstractAction
{
    /** The output action socket. */
    const SOCKET_OUTPUT = 'out';

    /** The left variable socket. */
    const SOCKET_LFT = 'lft';

    /** The right variable socket. */
    const SOCKET_RGT = 'rgt';

    /** The result variable socket. */
    const SOCKET_RESULT = 'result';

    /**
     * Initializes a new instance of this class.
     */
    public function __construct()
    {
        parent::__construct();

        $this->createSocket(self::SOCKET_OUTPUT);
        $this->createSocket(self::SOCKET_LFT);
        $this->createSocket(self::SOCKET_RGT);
        $this->createSocket(self::SOCKET_RESULT);
    }

    /**
     * Executes the node's logic.
     */
    public function execute()
    {
        $lft = $this->getSocket(self::SOCKET_LFT)->getNode(0);
        if ($lft === null || $lft->getValue() === null) {
            throw new \InvalidArgumentException('No left variable provided.');
        }

        $rgt = $this->getSocket(self::SOCKET_RGT)->getNode(0);
        if ($rgt === null || $rgt->getValue() === null) {
            throw new \InvalidArgumentException('No right variable provided.');
        }

        $result = $this->getSocket(self::SOCKET_RESULT)->getNode(0);
        if ($result === null) {
            throw new \InvalidArgumentException('No result variable provided.');
        }

        $calculatedValue = $this->calculateValue($lft->getValue(), $rgt->getValue());

        $result->setValue($calculatedValue);

        $this->activate(self::SOCKET_OUTPUT);
    }

    /**
     * The method that calculates the value.
     *
     * @param double|float|int $lft The left value.
     * @param double|float|int $rgt The right value.
     * @return double|float|int Returns the calculated value.
     */
    abstract protected function calculateValue($lft, $rgt);
}
