<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Mail\Action;

use NextFlow\Core\Action\AbstractAction;

/**
 * An action that makes it possible to send an e-mail.
 */
class SendMailAction extends AbstractAction
{
    /** The socket that is activated when this action is successful. */
    const SOCKET_OUTPUT_SUCCESS = 'success';

    /** The socket that is activated when this action is not successful. */
    const SOCKET_OUTPUT_ERROR = 'error';

    /** The socket that contains the addresses to send to. */
    const SOCKET_TO = 'to';

    /** The socket that contains the address to send to. */
    const SOCKET_SUBJECT = 'subject';

    /** The socket that contains the message to send. */
    const SOCKET_MESSAGE = 'message';

    /** The socket that contains the from address. */
    const SOCKET_FROM = 'from';

    /**
     * Initializes a new instance of this class.
     */
    public function __construct()
    {
        parent::__construct();

        $this->createSocket(self::SOCKET_OUTPUT_SUCCESS);
        $this->createSocket(self::SOCKET_OUTPUT_ERROR);
        $this->createSocket(self::SOCKET_TO);
        $this->createSocket(self::SOCKET_SUBJECT);
        $this->createSocket(self::SOCKET_MESSAGE);
        $this->createSocket(self::SOCKET_FROM);
    }

    /**
     * Executes the node's logic.
     */
    public function execute()
    {
        $toValue = $this->getSocket(self::SOCKET_TO)->getNode(0)->getValue();
        if ($toValue === null) {
            throw new \InvalidArgumentException('No address to send an e-mail to.');
        }

        $subjectValue = $this->getSocket(self::SOCKET_SUBJECT)->getNode(0)->getValue();
        if ($subjectValue === null) {
            throw new \InvalidArgumentException('There is no subject set.');
        }

        $messageValue = $this->getSocket(self::SOCKET_MESSAGE)->getNode(0)->getValue();
        if ($messageValue === null) {
            throw new \InvalidArgumentException('There is not message to send.');
        }

        $headers = $this->buildHeaders();

        if (mail($toValue, $subjectValue, $messageValue, $headers)) {
            $this->activate(self::SOCKET_OUTPUT_SUCCESS);
        } else {
            $this->activate(self::SOCKET_OUTPUT_ERROR);
        }
    }

    /**
     * Builds the headers that need to be send with the email.
     */
    private function buildHeaders()
    {
        $headers = 'X-Mailer: PHP/' . phpversion() . "\r\n";

        $fromSocket = $this->getSocket(self::SOCKET_FROM);
        if ($fromSocket->hasNodes()) {
            $fromValue = $fromSocket->getNode(0)->getValue();

            $headers .= 'From: ' . $fromValue . "\r\n";
            $headers .= 'Reply-To: ' . $fromValue . "\r\n";
        }
    }
}
