<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Core\Event;

/**
 * The interface that should be implemented by all events.
 */
interface EventInterface
{
    /**
     * Gets the name of the event.
     *
     * @return string
     */
    public function getName();
}
