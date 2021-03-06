<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Arrays\Action;

use NextFlow\Core\Node\NodeInterface;

/**
 * Pops an element from the front of an array.
 */
final class PopFrontAction extends AbstractPopAction
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

        $poppedValue = array_shift($arrayValue);

        $node->setValue($arrayValue);

        return $poppedValue;
    }
}
