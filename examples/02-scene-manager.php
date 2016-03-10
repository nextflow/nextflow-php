<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

use NextFlow\Core\Event\NamedEvent;
use NextFlow\Core\Scene\Scene;
use NextFlow\Core\Scene\SceneManager;
use NextFlow\Php\Action\EchoAction;
use NextFlow\Php\Variable\StringVariable;

require __DIR__ . '/../vendor/autoload.php';

function createEchoScene($value)
{
    $variable = new StringVariable();
    $variable->setValue($value);

    $action = new EchoAction();
    $action->bind(EchoAction::SOCKET_DATA, $variable);

    $event = new NamedEvent('demo');
    $event->bind(NamedEvent::SOCKET_OUT, $action);

    $scene = new Scene();
    $scene->addEvent($event);

    return $scene;
}

$sceneManager = new SceneManager();
$sceneManager->addScene(createEchoScene('Hello '));
$sceneManager->addScene(createEchoScene('world!'));
$sceneManager->execute('demo');
