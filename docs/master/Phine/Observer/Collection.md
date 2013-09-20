<small>Phine\Observer</small>

Collection
==========

Manages a collection of subjects.

Signature
---------

- It is a(n) **class**.
- It implements the [`CollectionInterface`](../../Phine/Observer/CollectionInterface.md) interface.

Methods
-------

The class defines the following methods:

- [`getSubject()`](#getSubject) &mdash; Returns the subject with the unique identifier.
- [`isSubjectRegistered()`](#isSubjectRegistered) &mdash; Checks if a subject is registered with this collection.
- [`registerSubject()`](#registerSubject) &mdash; Registers a new subject with the collection.
- [`replaceSubject()`](#replaceSubject) &mdash; Replaces a subject registered with a unique identifier.
- [`unregisterSubject()`](#unregisterSubject) &mdash; Unregisters a subject from the collection.
- [`updateSubject()`](#updateSubject) &mdash; Triggers an update for the subject with the unique identifier.

### `getSubject()` <a name="getSubject"></a>

Returns the subject with the unique identifier.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$id` (`string`) &mdash; The unique identifier.
- _Returns:_ The registered subject.
    - [`SubjectInterface`](../../Phine/Observer/SubjectInterface.md)
- It throws one of the following exceptions:
    - `CollectionException` &mdash; If the unique identifier is not used.

### `isSubjectRegistered()` <a name="isSubjectRegistered"></a>

Checks if a subject is registered with this collection.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$id` (`string`) &mdash; The unique identifier of the subject.
- _Returns:_ Returns `true` if a subject with the given unique identifier is registered with this collection. If a subject is not found, `false` is returned.
    - `boolean`

### `registerSubject()` <a name="registerSubject"></a>

Registers a new subject with the collection.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$id` (`string`) &mdash; The unique identifier.
    - `$subject` ([`SubjectInterface`](../../Phine/Observer/SubjectInterface.md)) &mdash; The subject to register.
- It does not return anything.
- It throws one of the following exceptions:
    - `CollectionException` &mdash; If the unique identifier is already used.

### `replaceSubject()` <a name="replaceSubject"></a>

Replaces a subject registered with a unique identifier.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$id` (`string`) &mdash; The unique identifier.
    - `$subject` ([`SubjectInterface`](../../Phine/Observer/SubjectInterface.md)) &mdash; The new subject.
- It does not return anything.
- It throws one of the following exceptions:
    - `CollectionException` &mdash; If the unique identifier is not used.

### `unregisterSubject()` <a name="unregisterSubject"></a>

Unregisters a subject from the collection.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$id` (`string`) &mdash; The unique identifier.
- It does not return anything.
- It throws one of the following exceptions:
    - `CollectionException` &mdash; If the unique identifier is not used.

### `updateSubject()` <a name="updateSubject"></a>

Triggers an update for the subject with the unique identifier.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$id` (`string`) &mdash; The unique identifier.
- It does not return anything.
- It throws one of the following exceptions:
    - `CollectionException` &mdash; If the unique identifier is not used.

