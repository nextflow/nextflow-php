<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Core\Serializer;

use NextFlow\Core\Scene\SceneInterface;

/**
 * An interface that should be implemented by a serializer.
 */
interface SerializerInterface
{
    /**
     * Serializes the given scene.
     *
     * @param $scene The scene to serialize.
     * @return string
     */
    public function serialize(SceneInterface $scene);

    /**
     * Unserializes the given data.
     *
     * @param string $data The data to unserialize.
     * @return SceneInterface
     */
    public function unserialize($data);
}
