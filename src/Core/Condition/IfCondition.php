<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Core\Condition;

use NextFlow\Core\Action\AbstractAction;

/**
 * A condition that compares two values with each other.
 */
class IfCondition extends AbstractAction
{
    /** The output socket that is activated when the values are equal. */
    const SOCKET_EQUAL = 'equal';

    /** The output socket that is activated when the values are not equal. */
    const SOCKET_NOT_EQUAL = 'not-equal';

    /** The output socket that is activated when the left value is less than the right value. */
    const SOCKET_LESS_THAN = 'less-than';

    /** The output socket that is activated when the left value is greater than the right value. */
    const SOCKET_GREATER_THAN = 'greater-than';

    /** The left value to compare. */
    const SOCKET_VALUELFT = 'value-lft';

    /** The right value to compare. */
    const SOCKET_VALUERGT = 'value-rgt';

    /**
     * Initializes a new instance of this class.
     */
    public function __construct()
    {
        parent::__construct();

        $this->createSocket(self::SOCKET_EQUAL);
        $this->createSocket(self::SOCKET_NOT_EQUAL);
        $this->createSocket(self::SOCKET_LESS_THAN);
        $this->createSocket(self::SOCKET_GREATER_THAN);
        $this->createSocket(self::SOCKET_VALUELFT);
        $this->createSocket(self::SOCKET_VALUERGT);
    }

    /**
     * Executes the node's logic.
     */
    public function execute()
    {
        $valueLft = $this->getSocket(self::SOCKET_VALUELFT)->getNode(0)->getValue();
        $valueRgt = $this->getSocket(self::SOCKET_VALUERGT)->getNode(0)->getValue();

        if ($valueLft === $valueRgt) {
            $this->activate(self::SOCKET_EQUAL);
        } else {
            if ($valueLft < $valueRgt) {
                $this->activate(self::SOCKET_LESS_THAN);
            } else {
                $this->activate(self::SOCKET_GREATER_THAN);
            }

            $this->activate(self::SOCKET_NOT_EQUAL);
        }
    }
}
