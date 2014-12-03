<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Core\Node\TestAsset;

use NextFlow\Core\Node\AbstractNode;

/**
 * @codeCoverageIgnore
 */
class DuplicateSocketDummy extends AbstractNode
{
    public function __construct()
    {
        parent::__construct();

        $this->createSocket('name');
        $this->createSocket('name');
    }

    public function execute()
    {
        // Nothing to do
    }
}
