<?php

namespace Phine\Observer;

use Phine\Observer\Exception\ReasonException;

/**
 * Defines how a subject class must be implemented.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
interface SubjectInterface
{
    /**
     * The first priority of an observer.
     *
     * @var integer
     */
    const FIRST_PRIORITY = 0;

    /**
     * The last priority of an observer.
     *
     * @var integer
     */
    const LAST_PRIORITY = PHP_INT_MAX;

    /**
     * Checks if a specific observer is registered with this subject.
     *
     * By default, if the `$observer` is registered with any priority, `true`
     * will be returned. However, if a `$priority` is specified, registrations
     * for only that priority will be checked. For example, if `$observer` was
     * originally registered with a priority of `4`, but the `$priority` to
     * check is `5`, `false` will be returned since the `$observer` was not
     * registered using that priority.
     *
     * @param ObserverInterface $observer The observer to check for.
     * @param integer           $priority The priority to limit the check to.
     *
     * @return boolean Returns `true` if the observer is registered with
     *                 this subject (and priority, if specified). If the
     *                 observer is not registered, `false` is returned.
     */
    public function hasObserver(ObserverInterface $observer, $priority = null);

    /**
     * Checks if this subject has any observers registered.
     *
     * By default, if any observer is registered with any priority, `true` will
     * be returned. However, if a `$priority` is specified, only registrations
     * for that priority will be checked. For example, if observers have only
     * been registered with a priority of `4`, but the `$priority` to check is
     * `5`, `false` will be returned.
     *
     * @param integer $priority The priority to limit the check to.
     *
     * @return boolean Returns `true` if there is at least one observer
     *                 registered. If no observers are registered, `false`
     *                 will be returned.
     */
    public function hasObservers($priority = null);

    /**
     * Interrupts the observer update process.
     *
     * When an update is interrupted, the given reason is saved to be later
     * thrown after the current observer has completed. If a reason is not
     * provided, the default "(no reason specified)" message will be used.
     *
     * @param ReasonException $reason A reason for the interruption.
     */
    public function interruptUpdate(ReasonException $reason = null);

    /**
     * Notifies all observers of an update from this subject.
     *
     * Observers are notified in the priority and order they are registered in.
     * Note that any single observer may interrupt the update process. When an
     * update is interrupted, the observer that initiated the interrupt may
     * finish, and then an exception is thrown stating the reason for the
     * interruption.
     *
     * @throws ReasonException If the update is interrupted.
     */
    public function notifyObservers();

    /**
     * Registers an observer with this subject.
     *
     * By default, an observer will be registered with a priority of `0` (zero).
     * The lower the number for the priority, the sooner it will be called when
     * an update is made by the subject. A priority of `0` (zero) is the earliest
     * priority possible, while `PHP_INT_MAX` is the latest priority possible.
     *
     * For convenience, the following constants are made available:
     *
     * - `SubjectInterface::FIRST_PRIORITY` &mdash; Priority `0` (zero).
     * - `SubjectInterface::LAST_PRIORITY` &mdash; Priority `PHP_INT_MAX`.
     *
     * @param ObserverInterface $observer The observer to register.
     * @param integer           $priority The priority of the observer.
     */
    public function registerObserver(
        ObserverInterface $observer,
        $priority = self::FIRST_PRIORITY
    );

    /**
     * Unregisters all observers from this subject.
     *
     * By default, all observer registrations will be removed, regardless of
     * their priorities. If an `$observer` is provided, all registrations of
     * only that observer will be removed. If `$priority` is provided, only
     * registrations of that priority will be removed.
     *
     * @param ObserverInterface $observer The observer to unregister.
     * @param integer           $priority The priority to limit to.
     */
    public function unregisterAllObservers(
        ObserverInterface $observer = null,
        $priority = null
    );

    /**
     * Unregisters an observer from this subject.
     *
     * By default, only one instance of the observer's registration will be
     * removed, regardless of its priority. If `$priority` is set, only the
     * first occurrence for that priority will be removed. To remove all
     * occurrences of the `$observer` being registered, you will need to use
     * the {@link unregisterAllObservers} method.
     *
     * @param ObserverInterface $observer The observer to unregister.
     * @param integer           $priority The priority to limit to.
     */
    public function unregisterObserver(
        ObserverInterface $observer,
        $priority = null
    );
}
