<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Arrays\Action;

use NextFlow\Core\Node\NodeInterface;

/**
 * Pops an element from the back of an array.
 */
class PopBackAction extends AbstractPopAction
{
    /**
     * Executes the pop logic.
     *
     * @param NodeInterface $node The node to pop data from.
     * @return mixed
     */
    protected function executePop(NodeInterface $node)
    {
        $arrayValue = $node->getValue();

        $poppedValue = array_pop($arrayValue);

        $node->setValue($arrayValue);

        return $poppedValue;
    }
}
