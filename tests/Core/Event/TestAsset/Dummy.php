<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Core\Event\TestAsset;

use NextFlow\Core\Event\AbstractEvent;

/**
 * @codeCoverageIgnore
 */
class Dummy extends AbstractEvent
{
    public function execute()
    {
        // Nothing to do
    }
}
