<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Core\Scene;

/**
 * A scene manager is able to handle events in multiple scenes.
 */
final class SceneManager
{
    /**
     * A list with all the scenes.
     *
     * @var array
     */
    private $scenes;

    /**
     * Initializes a new instance of the SceneManager class.
     */
    public function __construct()
    {
        $this->scenes = [];
    }

    /**
     * Adds the given scene to this manager.
     *
     * @param SceneInterface $scene The scene to add.
     */
    public function addScene(SceneInterface $scene)
    {
        $this->scenes[] = $scene;
    }

    /**
     * Gets the scenes that this scene manager has.
     *
     * @return SceneInterface[]
     */
    public function getScenes()
    {
        return $this->scenes;
    }

    /**
     * Executes the given event.
     *
     * @param string $name The name of the event to execute.
     * @return array
     */
    public function execute($name)
    {
        $result = [];

        foreach ($this->scenes as $scene) {
            $result[] = $scene->execute($name);
        }

        return $result;
    }
}
