<small>Phine\Observer</small>

SubjectInterface
================

Defines how a subject class must be implemented.

Signature
---------

- It is a(n) **interface**.

Constants
---------

This interface defines the following constants:

- [`FIRST_PRIORITY`](#FIRST_PRIORITY) &mdash; The first priority of an observer.
- [`LAST_PRIORITY`](#LAST_PRIORITY) &mdash; The last priority of an observer.

Methods
-------

The interface defines the following methods:

- [`hasObserver()`](#hasObserver) &mdash; Checks if a specific observer is registered with this subject.
- [`hasObservers()`](#hasObservers) &mdash; Checks if this subject has any observers registered.
- [`interruptUpdate()`](#interruptUpdate) &mdash; Interrupts the observer update process.
- [`notifyObservers()`](#notifyObservers) &mdash; Notifies all observers of an update from this subject.
- [`registerObserver()`](#registerObserver) &mdash; Registers an observer with this subject.
- [`unregisterAllObservers()`](#unregisterAllObservers) &mdash; Unregisters all observers from this subject.
- [`unregisterObserver()`](#unregisterObserver) &mdash; Unregisters an observer from this subject.

### `hasObserver()` <a name="hasObserver"></a>

Checks if a specific observer is registered with this subject.

#### Description

By default, if the `$observer` is registered with any priority, `true`
will be returned. However, if a `$priority` is specified, registrations
for only that priority will be checked. For example, if `$observer` was
originally registered with a priority of `4`, but the `$priority` to
check is `5`, `false` will be returned since the `$observer` was not
registered using that priority.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$observer` ([`ObserverInterface`](../../Phine/Observer/ObserverInterface.md)) &mdash; The observer to check for.
    - `$priority` (`integer`) &mdash; The priority to limit the check to.
- _Returns:_ Returns `true` if the observer is registered with this subject (and priority, if specified). If the observer is not registered, `false` is returned.
    - `boolean`

### `hasObservers()` <a name="hasObservers"></a>

Checks if this subject has any observers registered.

#### Description

By default, if any observer is registered with any priority, `true` will
be returned. However, if a `$priority` is specified, only registrations
for that priority will be checked. For example, if observers have only
been registered with a priority of `4`, but the `$priority` to check is
`5`, `false` will be returned.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$priority` (`integer`) &mdash; The priority to limit the check to.
- _Returns:_ Returns `true` if there is at least one observer registered. If no observers are registered, `false` will be returned.
    - `boolean`

### `interruptUpdate()` <a name="interruptUpdate"></a>

Interrupts the observer update process.

#### Description

When an update is interrupted, the given reason is saved to be later
thrown after the current observer has completed. If a reason is not
provided, the default &quot;(no reason specified)&quot; message will be used.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$reason` ([`ReasonException`](../../Phine/Observer/Exception/ReasonException.md)) &mdash; A reason for the interruption.
- It does not return anything.

### `notifyObservers()` <a name="notifyObservers"></a>

Notifies all observers of an update from this subject.

#### Description

Observers are notified in the priority and order they are registered in.
Note that any single observer may interrupt the update process. When an
update is interrupted, the observer that initiated the interrupt may
finish, and then an exception is thrown stating the reason for the
interruption.

#### Signature

- It is a **public** method.
- It does not return anything.
- It throws one of the following exceptions:
    - `ReasonException` &mdash; If the update is interrupted.

### `registerObserver()` <a name="registerObserver"></a>

Registers an observer with this subject.

#### Description

By default, an observer will be registered with a priority of `0` (zero).
The lower the number for the priority, the sooner it will be called when
an update is made by the subject. A priority of `0` (zero) is the earliest
priority possible, while `PHP_INT_MAX` is the latest priority possible.

For convenience, the following constants are made available:

- `SubjectInterface::FIRST_PRIORITY` &amp;mdash; Priority `0` (zero).
- `SubjectInterface::LAST_PRIORITY` &amp;mdash; Priority `PHP_INT_MAX`.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$observer` ([`ObserverInterface`](../../Phine/Observer/ObserverInterface.md)) &mdash; The observer to register.
    - `$priority` (`integer`) &mdash; The priority of the observer.
- It does not return anything.

### `unregisterAllObservers()` <a name="unregisterAllObservers"></a>

Unregisters all observers from this subject.

#### Description

By default, all observer registrations will be removed, regardless of
their priorities. If an `$observer` is provided, all registrations of
only that observer will be removed. If `$priority` is provided, only
registrations of that priority will be removed.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$observer` ([`ObserverInterface`](../../Phine/Observer/ObserverInterface.md)) &mdash; The observer to unregister.
    - `$priority` (`integer`) &mdash; The priority to limit to.
- It does not return anything.

### `unregisterObserver()` <a name="unregisterObserver"></a>

Unregisters an observer from this subject.

#### Description

By default, only one instance of the observer&#039;s registration will be
removed, regardless of its priority. If `$priority` is set, only the
first occurrence for that priority will be removed. To remove all
occurrences of the `$observer` being registered, you will need to use
the {@link unregisterAllObservers} method.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$observer` ([`ObserverInterface`](../../Phine/Observer/ObserverInterface.md)) &mdash; The observer to unregister.
    - `$priority` (`integer`) &mdash; The priority to limit to.
- It does not return anything.

