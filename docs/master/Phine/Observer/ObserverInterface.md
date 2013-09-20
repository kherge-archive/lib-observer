<small>Phine\Observer</small>

ObserverInterface
=================

Defines how an observer class must be implemented.

Signature
---------

- It is a(n) **interface**.

Methods
-------

The interface defines the following methods:

- [`receiveUpdate()`](#receiveUpdate) &mdash; Receives an update from an observed subject.

### `receiveUpdate()` <a name="receiveUpdate"></a>

Receives an update from an observed subject.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$subject` ([`SubjectInterface`](../../Phine/Observer/SubjectInterface.md)) &mdash; The subject being observed.
- It does not return anything.

