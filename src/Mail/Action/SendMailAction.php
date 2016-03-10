<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Mail\Action;

use InvalidArgumentException;
use NextFlow\Core\Action\AbstractAction;
use NextFlow\Mail\Transport\TransportInterface;
use RuntimeException;

/**
 * An action that makes it possible to send an e-mail.
 */
final class SendMailAction extends AbstractAction
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
     * @var TransportInterface
     */
    private $transport;

    /**
     * Initializes a new instance of this class.
     *
     * @param TransportInterface $transport The mail transport used to send email messages.
     */
    public function __construct(TransportInterface $transport)
    {
        parent::__construct();

        $this->createSocket(self::SOCKET_OUTPUT_SUCCESS);
        $this->createSocket(self::SOCKET_OUTPUT_ERROR);
        $this->createSocket(self::SOCKET_TO);
        $this->createSocket(self::SOCKET_SUBJECT);
        $this->createSocket(self::SOCKET_MESSAGE);
        $this->createSocket(self::SOCKET_FROM);

        $this->transport = $transport;
    }

    /**
     * Executes the node's logic.
     */
    public function execute()
    {
        $params = [
            'to' => $this->getSocketValue(self::SOCKET_TO, 'No address to send an e-mail to.'),
            'subject' => $this->getSocketValue(self::SOCKET_SUBJECT, 'There is no subject set.'),
            'message' => $this->getSocketValue(self::SOCKET_MESSAGE, 'There is no message to send.'),
            'from' => $this->getSocketValue(self::SOCKET_FROM, 'There is no from address set.'),
        ];

        $result = $this->transport->send($params);

        if ($result) {
            $this->activate(self::SOCKET_OUTPUT_SUCCESS);
        } else {
            $this->activate(self::SOCKET_OUTPUT_ERROR);
        }
    }

    /**
     * Gets the value of the given socket.
     *
     * @param string $socketName The name of the socket to get the value for.
     * @param string $message The message of the exception that is thrown in case of an error.
     * @return mixed
     * @throws RuntimeException Thrown when there are no nodes.
     */
    private function getSocketValue($socketName, $message)
    {
        $socket = $this->getSocket($socketName);
        if (!$socket || !$socket->hasNodes()) {
            throw new RuntimeException(sprintf('The socket "%s" has no nodes.', $socketName));
        }

        $value = $socket->getNode(0)->getValue();

        if ($value === null) {
            throw new InvalidArgumentException($message);
        }

        return $value;
    }
}
