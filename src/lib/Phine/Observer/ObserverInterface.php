<?php

namespace Phine\Observer;

/**
 * Defines how an observer class must be implemented.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
interface ObserverInterface
{
    /**
     * Receives an update from an observed subject.
     *
     * @param SubjectInterface $subject The subject being observed.
     */
    public function receiveUpdate(SubjectInterface $subject);
}