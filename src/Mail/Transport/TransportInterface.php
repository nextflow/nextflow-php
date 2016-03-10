<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Mail\Transport;

/**
 * An interface that should be implemented by the transport for sending emails.
 */
interface TransportInterface
{
    /**
     * Sends an email based on the given parameters.
     *
     * @param array $params The parameters used to build the e-mail message.
     * @return bool
     */
    public function send(array $params);
}
