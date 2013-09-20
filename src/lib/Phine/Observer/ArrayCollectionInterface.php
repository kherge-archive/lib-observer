<?php

namespace Phine\Observer;

use ArrayAccess;

/**
 * Defines how an array accessible subject collection class must be implemented.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
interface ArrayCollectionInterface extends ArrayAccess, CollectionInterface
{
    /**
     * Checks if a subject is registered with this collection.
     *
     * @param string $id The unique identifier of the subject.
     *
     * @return boolean Returns `true` if a subject with the given unique
     *                 identifier is registered with this collection. If
     *                 a subject is not found, `false` is returned.
     */
    public function offsetExists($id);

    /**
     * Returns the subject with the unique identifier.
     *
     * @param string $id The unique identifier.
     *
     * @return SubjectInterface The registered subject.
     */
    public function offsetGet($id);

    /**
     * Registers or replaces a subject with the unique identifier.
     *
     * If a subject is not registered with the unique identifier, it will
     * be registered. If a subject has already been registered with the
     * unique identifier, it will be replaced instead.
     *
     * @param string           $id      The unique identifier.
     * @param SubjectInterface $subject The subject to register.
     */
    public function offsetSet($id, $subject);

    /**
     * Unregisters a subject from the collection.
     *
     * @param string $id The unique identifier.
     */
    public function offsetUnset($id);
}
