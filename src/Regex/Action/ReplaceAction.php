<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Regex\Action;

use NextFlow\Core\Action\AbstractAction;

/**
 * A replace action that replaces a string with another string based on a regular expression.
 */
final class ReplaceAction extends AbstractAction
{
    /** The output socket. */
    const SOCKET_OUTPUT = 'out';

    /** The pattern variable socket. */
    const SOCKET_PATTERN = 'pattern';

    /** The replacement variable socket. */
    const SOCKET_REPLACEMENT = 'replacement';

    /** The subject variable socket. */
    const SOCKET_SUBJECT = 'subject';

    /** The result variable socket. */
    const SOCKET_RESULT = 'result';

    /**
     * Initializes a new instance of this class.
     */
    public function __construct()
    {
        parent::__construct();

        $this->createSocket(self::SOCKET_OUTPUT);
        $this->createSocket(self::SOCKET_PATTERN);
        $this->createSocket(self::SOCKET_REPLACEMENT);
        $this->createSocket(self::SOCKET_SUBJECT);
        $this->createSocket(self::SOCKET_RESULT);
    }

    /**
     * Executes the node's logic.
     */
    public function execute()
    {
        $pattern = $this->getSocket(self::SOCKET_PATTERN)->getNode(0);
        if ($pattern === null || $pattern->getValue() === null) {
            throw new \InvalidArgumentException('No pattern provided.');
        }

        $replacement = $this->getSocket(self::SOCKET_REPLACEMENT)->getNode(0);
        if ($replacement === null || $replacement->getValue() === null) {
            throw new \InvalidArgumentException('No replacement provided.');
        }

        $subject = $this->getSocket(self::SOCKET_SUBJECT)->getNode(0);
        if ($subject === null || $subject->getValue() === null) {
            throw new \InvalidArgumentException('No subject provided.');
        }

        $resultVar = $this->getSocket(self::SOCKET_RESULT)->getNode(0);
        if ($resultVar === null) {
            throw new \InvalidArgumentException('No result variable provided.');
        }

        $value = preg_replace($pattern->getValue(), $replacement->getValue(), $subject->getValue());

        $resultVar->setValue($value);

        $this->activate(self::SOCKET_OUTPUT);
    }
}
