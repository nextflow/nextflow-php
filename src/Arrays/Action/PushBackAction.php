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
 * Pushes an element at the back of an array.
 */
final class PushBackAction extends AbstractPushAction
{
    /**
     * Executes the push logic.
     *
     * @param NodeInterface $node The node to push data to.
     * @param mixed $value The value to push.
     */
    protected function executePush(NodeInterface $node, $value)
    {
        $arrayValue = $node->getValue();

        $arrayValue[] = $value;

        $node->setValue($arrayValue);
    }
}
