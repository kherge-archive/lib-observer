<small>Phine\Observer\Exception</small>

CollectionException
===================

Exception thrown when a problem with the collection is encountered.

Signature
---------

- It is a(n) **class**.
- It is a subclass of `Phine\Exception\Exception`.

Methods
-------

The class defines the following methods:

- [`idNotUsed()`](#idNotUsed) &mdash; Creates a new exception for a unique identifier that is not used.
- [`idUsed()`](#idUsed) &mdash; Creates a new exception for a unique identifier that is already used.

### `idNotUsed()` <a name="idNotUsed"></a>

Creates a new exception for a unique identifier that is not used.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$id` (`string`) &mdash; The unique identifier.
- _Returns:_ The new exception.
    - [`CollectionException`](../../../Phine/Observer/Exception/CollectionException.md)

### `idUsed()` <a name="idUsed"></a>

Creates a new exception for a unique identifier that is already used.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$id` (`string`) &mdash; The unique identifier.
- _Returns:_ The new exception.
    - [`CollectionException`](../../../Phine/Observer/Exception/CollectionException.md)

