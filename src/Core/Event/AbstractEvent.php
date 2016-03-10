<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Core\Event;

use NextFlow\Core\Node\AbstractNode;

/**
 * The base final class for all events. An event is a node that has no input
 * connectors and is activated by code.
 */
abstract class AbstractEvent extends AbstractNode implements EventInterface
{
    /**
     * Gets the name of the event.
     *
     * @return string
     */
    public function getName()
    {
        return get_class($this);
    }
}
