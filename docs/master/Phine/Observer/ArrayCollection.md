<small>Phine\Observer</small>

ArrayCollection
===============

Manages an array accessible collection of subjects.

Signature
---------

- It is a(n) **class**.
- It implements the [`ArrayCollectionInterface`](../../Phine/Observer/ArrayCollectionInterface.md) interface.
- It is a subclass of [`Collection`](../../Phine/Observer/Collection.md).

Methods
-------

The class defines the following methods:

- [`offsetExists()`](#offsetExists) &mdash; Checks if a subject is registered with this collection.
- [`offsetGet()`](#offsetGet) &mdash; Returns the subject with the unique identifier.
- [`offsetSet()`](#offsetSet) &mdash; Registers or replaces a subject with the unique identifier.
- [`offsetUnset()`](#offsetUnset) &mdash; Unregisters a subject from the collection.

### `offsetExists()` <a name="offsetExists"></a>

Checks if a subject is registered with this collection.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$id` (`string`) &mdash; The unique identifier of the subject.
- _Returns:_ Returns `true` if a subject with the given unique identifier is registered with this collection. If a subject is not found, `false` is returned.
    - `boolean`

### `offsetGet()` <a name="offsetGet"></a>

Returns the subject with the unique identifier.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$id` (`string`) &mdash; The unique identifier.
- _Returns:_ The registered subject.
    - [`SubjectInterface`](../../Phine/Observer/SubjectInterface.md)

### `offsetSet()` <a name="offsetSet"></a>

Registers or replaces a subject with the unique identifier.

#### Description

If a subject is not registered with the unique identifier, it will
be registered. If a subject has already been registered with the
unique identifier, it will be replaced instead.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$id` (`string`) &mdash; The unique identifier.
    - `$subject` ([`SubjectInterface`](../../Phine/Observer/SubjectInterface.md)) &mdash; The subject to register.
- It does not return anything.

### `offsetUnset()` <a name="offsetUnset"></a>

Unregisters a subject from the collection.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$id` (`string`) &mdash; The unique identifier.
- It does not return anything.

