<?php

namespace Phine\Observer;

use Phine\Observer\Exception\CollectionException;

/**
 * Manages a collection of subjects.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class Collection implements CollectionInterface
{
    /**
     * The registered subjects.
     *
     * @var SubjectInterface[]
     */
    private $subjects = array();

    /**
     * {@inheritDoc}
     */
    public function getSubject($id)
    {
        if (!isset($this->subjects[$id])) {
            throw CollectionException::idNotUsed($id);
        }

        return $this->subjects[$id];
    }

    /**
     * {@inheritDoc}
     */
    public function isSubjectRegistered($id)
    {
        return isset($this->subjects[$id]);
    }

    /**
     * {@inheritDoc}
     */
    public function registerSubject($id, SubjectInterface $subject)
    {
        if (isset($this->subjects[$id])) {
            throw CollectionException::idUsed($id);
        }

        $this->subjects[$id] = $subject;
    }

    /**
     * {@inheritDoc}
     */
    public function replaceSubject($id, SubjectInterface $subject)
    {
        if (!isset($this->subjects[$id])) {
            throw CollectionException::idNotUsed($id);
        }

        $this->subjects[$id] = $subject;
    }

    /**
     * {@inheritDoc}
     */
    public function unregisterSubject($id)
    {
        if (!isset($this->subjects[$id])) {
            throw CollectionException::idNotUsed($id);
        }

        unset($this->subjects[$id]);
    }

    /**
     * {@inheritDoc}
     */
    public function updateSubject($id)
    {
        if (!isset($this->subjects[$id])) {
            throw CollectionException::idNotUsed($id);
        }

        $this->subjects[$id]->notifyObservers();
    }
}