<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Php\Action;

use NextFlow\Core\Action\AbstractAction;

/**
 * An action that invokes a callback.
 */
final class CallbackAction extends AbstractAction
{
    /** The constant that defines the output socket. */
    const SOCKET_OUTPUT = 'out';

    /**
     * The callback that should be invoked.
     *
     * @var callable
     */
    private $callback;

    /**
     * Initializes a new instance of this class.
     *
     * @param callable $callback The callback.
     */
    public function __construct($callback)
    {
        parent::__construct();

        if (!is_callable($callback)) {
            throw new \InvalidArgumentException('The provided callback is not callable.');
        }

        $this->callback = $callback;

        $this->createSocket(self::SOCKET_OUTPUT);
    }

    /**
     * Executes the node's logic.
     */
    public function execute()
    {
        call_user_func_array($this->callback, array($this));

        $this->activate(self::SOCKET_OUTPUT);
    }
}
