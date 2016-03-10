<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Core\Condition;

use NextFlow\Core\Action\AbstractAction;

/**
 * A condition that checks if a value is within a range.
 */
final class RangeCondition extends AbstractAction
{
    /** The socket that is activated when the result is true. */
    const SOCKET_TRUE = 'true';

    /** The socket that is activated when the result is false. */
    const SOCKET_FALSE = 'false';

    /** The socket for the minimum value variable. */
    const SOCKET_MIN = 'minimum';

    /** The socket for the maximum value variable. */
    const SOCKET_MAX = 'maximum';

    /** The socket for the value that should be compared.. */
    const SOCKET_VALUE = 'value';

    /**
     * Initializes a new instance of this class.
     */
    public function __construct()
    {
        parent::__construct();

        $this->createSocket(self::SOCKET_TRUE);
        $this->createSocket(self::SOCKET_FALSE);
        $this->createSocket(self::SOCKET_MIN);
        $this->createSocket(self::SOCKET_MAX);
        $this->createSocket(self::SOCKET_VALUE);
    }

    /**
     * Executes the node's logic.
     */
    public function execute()
    {
        $minVal = $this->getSocket(self::SOCKET_MIN)->getNode(0)->getValue();
        $maxVal = $this->getSocket(self::SOCKET_MAX)->getNode(0)->getValue();
        $value = $this->getSocket(self::SOCKET_VALUE)->getNode(0)->getValue();

        if ($value >= $minVal && $value <= $maxVal) {
            $this->activate(self::SOCKET_TRUE);
        } else {
            $this->activate(self::SOCKET_FALSE);
        }
    }
}
