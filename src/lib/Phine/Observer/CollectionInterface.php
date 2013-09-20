<?php

namespace Phine\Observer;

use Phine\Observer\Exception\CollectionException;

/**
 * Defines how a subject collection class must be implemented.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
interface CollectionInterface
{
    /**
     * Returns the subject with the unique identifier.
     *
     * @param string $id The unique identifier.
     *
     * @return SubjectInterface The registered subject.
     *
     * @throws CollectionException If the unique identifier is not used.
     */
    public function getSubject($id);

    /**
     * Checks if a subject is registered with this collection.
     *
     * @param string $id The unique identifier of the subject.
     *
     * @return boolean Returns `true` if a subject with the given unique
     *                 identifier is registered with this collection. If
     *                 a subject is not found, `false` is returned.
     */
    public function isSubjectRegistered($id);

    /**
     * Registers a new subject with the collection.
     *
     * @param string           $id      The unique identifier.
     * @param SubjectInterface $subject The subject to register.
     *
     * @throws CollectionException If the unique identifier is already used.
     */
    public function registerSubject($id, SubjectInterface $subject);

    /**
     * Replaces a subject registered with a unique identifier.
     *
     * @param string           $id      The unique identifier.
     * @param SubjectInterface $subject The new subject.
     *
     * @throws CollectionException If the unique identifier is not used.
     */
    public function replaceSubject($id, SubjectInterface $subject);

    /**
     * Unregisters a subject from the collection.
     *
     * @param string $id The unique identifier.
     *
     * @throws CollectionException If the unique identifier is not used.
     */
    public function unregisterSubject($id);

    /**
     * Triggers an update for the subject with the unique identifier.
     *
     * @param string $id The unique identifier.
     *
     * @throws CollectionException If the unique identifier is not used.
     */
    public function updateSubject($id);
}
