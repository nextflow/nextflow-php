<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlowTest\Core\Scene;

use NextFlow\Core\Scene\Scene;
use NextFlow\Core\Scene\SceneManager;
use PHPUnit_Framework_TestCase;

class SceneManagerTest extends PHPUnit_Framework_TestCase
{
    public function testEmptySceneManager()
    {
        // Arrange
        $sceneManager = new SceneManager();

        // Act
        $scenes = $sceneManager->getScenes();

        // Assert
        $this->assertCount(0, $scenes);
    }

    public function testAddScene()
    {
        // Arrange
        $sceneManager = new SceneManager();

        // Act
        $sceneManager->addScene(new Scene());

        // Assert
        $this->assertCount(1, $sceneManager->getScenes());
    }

    public function testExecute()
    {
        // Arrange
        $sceneManager = new SceneManager();
        $sceneManager->addScene(new Scene());

        // Act
        $result = $sceneManager->execute('demo');

        // Assert
        $this->assertCount(1, $result);
    }

    public function testExecuteEmptySceneManager()
    {
        // Arrange
        $sceneManager = new SceneManager();

        // Act
        $result = $sceneManager->execute('demo');

        // Assert
        $this->assertCount(0, $result);
    }
}
