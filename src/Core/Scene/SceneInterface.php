<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014-2016 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Core\Scene;

use NextFlow\Core\Event\EventInterface;

/**
 * The interface that should be implemented by all scenes.
 */
interface SceneInterface
{
    /**
     * Executes the event with the given name.
     *
     * @param string $eventName The name of the event to execute.
     * @return int Returns the amount of events that are executed.
     */
    public function execute($eventName);

    /**
     * Adds the given event to this scene.
     *
     * @param EventInterface $event The event to add.
     */
    public function addEvent(EventInterface $event);

    /**
     * Clears all the events within the scene.
     */
    public function clearEvents();

    /**
     * Gets a list with all events that are registered.
     *
     * @return EventInterface[]
     */
    public function getEvents();

    /**
     * Gets the name of the scene.
     *
     * @return string
     */
    public function getName();

    /**
     * Removes the given event from the scene.
     *
     * @param EventInterface $event The event to remove.
     */
    public function removeEvent(EventInterface $event);

    /**
     * Sets the name of the scene.
     *
     * @param string $name The name to set.
     */
    public function setName($name);
}
