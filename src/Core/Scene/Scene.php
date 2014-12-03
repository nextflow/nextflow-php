<?php
/**
 * NextFlow (http://github.com/nextflow)
 *
 * @link http://github.com/nextflow/nextflow-php for the canonical source repository
 * @copyright Copyright (c) 2014 NextFlow (http://github.com/nextflow)
 * @license https://raw.github.com/nextflow/nextflow-php/master/LICENSE MIT
 */

namespace NextFlow\Core\Scene;

use NextFlow\Core\Event\EventInterface;

/**
 * A scene that contains event nodes that can be executed.
 */
class Scene implements SceneInterface
{
    /**
     * The name of the scene.
     *
     * @var string
     */
    private $name;

    /**
     * The list with events that can be executed.
     *
     * @var EventInterface[]
     */
    private $events;

    /**
     * Initializes a new instance of this class.
     */
    public function __construct()
    {
        $this->events = array();
    }

    /**
     * Executes the event with the given name.
     *
     * @param string $eventName The name of the event to execute.
     * @return int Returns the amount of events that are executed.
     */
    public function execute($eventName)
    {
        $result = 0;

        foreach ($this->events as $event) {
            if ($event->getName() == $eventName) {
                $event->execute();
                $result++;
            }
        }

        return $result;
    }

    /**
     * Adds the given event to this scene.
     *
     * @param EventInterface $event
     */
    public function addEvent(EventInterface $event)
    {
        if (!in_array($event, $this->events)) {
            $this->events[] = $event;
        }
    }

    /**
     * Clears all the events within the scene.
     */
    public function clearEvents()
    {
        $this->events = array();
    }

    /**
     * Gets a list with all events that are registered.
     *
     * @return EventInterface[]
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Gets the name of the scene.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Removes the given event from the scene.
     *
     * @param EventInterface $event The event to remove.
     */
    public function removeEvent(EventInterface $event)
    {
        $key = array_search($event, $this->events, true);
        if ($key !== false) {
            unset($this->events[$key]);
        }
    }

    /**
     * Sets the name of the scene.
     *
     * @param string $name The name to set.
     */
    public function setName($name)
    {
        $this->name = (string)$name;
    }
}
