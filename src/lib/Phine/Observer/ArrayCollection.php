<?php

namespace Phine\Observer;

/**
 * Manages an array accessible collection of subjects.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class ArrayCollection extends Collection implements ArrayCollectionInterface
{
    /**
     * {@inheritDoc}
     */
    public function offsetExists($id)
    {
        return $this->isSubjectRegistered($id);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetGet($id)
    {
        return $this->getSubject($id);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($id, $subject)
    {
        if ($this->isSubjectRegistered($id)) {
            $this->replaceSubject($id, $subject);
        } else {
            $this->registerSubject($id, $subject);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset($id)
    {
        if ($this->isSubjectRegistered($id)) {
            $this->unregisterSubject($id);
        }
    }
}