<?php

namespace Phine\Observer;

use Phine\Observer\Exception\ReasonException;

/**
 * The default implementation of the {@link SubjectInterface} interface.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class Subject implements SubjectInterface
{
    /**
     * The registered observers.
     *
     * @var array
     */
    private $observers = array();

    /**
     * The reason for the last interrupt.
     *
     * @var ReasonException
     */
    private $reason;

    /**
     * {@inheritDoc}
     */
    public function hasObserver(ObserverInterface $observer, $priority = null)
    {
        if (null === $priority) {
            foreach ($this->observers as $observers) {
                if (in_array($observer, $observers, true)) {
                    return true;
                }
            }
        } elseif (isset($this->observers[$priority])) {
            return in_array($observer, $this->observers[$priority], true);
        }

        return false;
    }

    /**
     * {@inheritDocs}
     */
    public function hasObservers($priority = null)
    {
        if (null === $priority) {
            foreach ($this->observers as $observers) {
                if (!empty($observers)) {
                    return true;
                }
            }
        } elseif (isset($this->observers[$priority])) {
            return !empty($this->observers[$priority]);
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function interruptUpdate(ReasonException $reason = null)
    {
        if (null === $reason) {
            $reason = ReasonException::notSpecified();
        }

        $this->reason = $reason;
    }

    /**
     * {@inheritDoc}
     */
    public function notifyObservers()
    {
        $this->resetInterrupt();
        $this->sortObservers();

        /** @var ObserverInterface $observer */
        foreach ($this->observers as $observers) {
            foreach ($observers as $observer) {
                $observer->receiveUpdate($this);

                if ($this->reason) {
                    throw $this->reason;
                }
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function registerObserver(
        ObserverInterface $observer,
        $priority = self::FIRST_PRIORITY
    ) {
        if (!isset($this->observers[$priority])) {
            $this->observers[$priority] = array();
        }

        $this->observers[$priority][] = $observer;
    }

    /**
     * {@inheritDoc}
     */
    public function unregisterAllObservers(
        ObserverInterface $observer = null,
        $priority = null
    ) {
        if ($observer) {
            if (null === $priority) {
                foreach ($this->observers as $priority => $observers) {
                    foreach (array_keys($observers, $observer, true) as $key) {
                        unset($this->observers[$priority][$key]);
                    }
                }
            } elseif (isset($this->observers[$priority])) {
                foreach (array_keys($this->observers[$priority], $observer, true) as $key) {
                    unset($this->observers[$priority][$key]);
                }
            }
        } elseif (null === $priority) {
            $this->observers = array();
        } else {
            unset($this->observers[$priority]);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function unregisterObserver(
        ObserverInterface $observer,
        $priority = null
    ) {
        if (null === $priority) {
            $this->sortObservers();

            foreach ($this->observers as $priority => $observers) {
                if (false !== ($key = array_search($observer, $observers, true))) {
                    unset($this->observers[$priority][$key]);

                    break;
                }
            }
        } elseif (isset($this->observers[$priority])) {
            if (false !== ($key = array_search($observer, $this->observers[$priority], true))) {
                unset($this->observers[$priority][$key]);
            }
        }
    }

    /**
     * Resets any interruption made by the last update.
     */
    protected function resetInterrupt()
    {
        $this->reason = null;
    }

    /**
     * Sorts the observers according to their priorities.
     */
    protected function sortObservers()
    {
        ksort($this->observers, SORT_NUMERIC);
    }
}
