<?php

namespace Phine\Observer\Tests;

use Phine\Observer\Collection;
use Phine\Observer\Subject;
use Phine\Observer\Test\Observer;
use Phine\Test\Property;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Tests the methods in the {@link Collection} class.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class CollectionTest extends TestCase
{
    /**
     * The collection to test.
     *
     * @var Collection
     */
    private $collection;

    /**
     * Make sure that we can retrieve a registered subject.
     */
    public function testGetSubject()
    {
        $subject = new Subject();

        Property::set($this->collection, 'subjects', array('test' => $subject));

        $this->assertSame(
            $subject,
            $this->collection->getSubject('test'),
            'Make sure we get back the same subject.'
        );
    }

    /**
     * Make sure that an exception is thrown if the subject is not registered.
     */
    public function testGetSubjectNotRegistered()
    {
        $this->setExpectedException(
            'Phine\\Observer\\Exception\\CollectionException',
            'The "test" subject unique identifier is not in use.'
        );

        $this->collection->getSubject('test');
    }

    /**
     * Make sure we can check if a subject is registered.
     */
    public function testIsSubjectRegistered()
    {
        $this->assertFalse(
            $this->collection->isSubjectRegistered('test'),
            'Make sure the "test" subject is not registered.'
        );

        Property::set(
            $this->collection,
            'subjects',
            array('test' => new Subject())
        );

        $this->assertTrue(
            $this->collection->isSubjectRegistered('test'),
            'Make sure the "test" subject is registered.'
        );
    }

    /**
     * Make sure we can register a subject.
     */
    public function testRegisterSubject()
    {
        $subject = new Subject();


        $this->collection->registerSubject('test', $subject);

        $this->assertSame(
            array('test' => $subject),
            Property::get($this->collection, 'subjects'),
            'Make sure that the "test" subject is registered.'
        );
    }

    /**
     * Make sure an exception is thrown if the subject is already registered.
     */
    public function testRegisterSubjectDuplicate()
    {
        $subject = new Subject();

        $this->collection->registerSubject('test', $subject);

        $this->setExpectedException(
            'Phine\\Observer\\Exception\\CollectionException',
            'The "test" subject unique identifier is already in use.'
        );

        $this->collection->registerSubject('test', $subject);
    }

    /**
     * Make sure that we can replace a registered subject.
     */
    public function testReplaceSubject()
    {
        $subject = new Subject();

        Property::set($this->collection, 'subjects', array('test' => $subject));

        $new = new Subject();

        $this->collection->replaceSubject('test', $new);

        $this->assertSame(
            array('test' => $new),
            Property::get($this->collection, 'subjects'),
            'Make sure the "test" subject is replaced.'
        );
    }

    /**
     * Make sure an exception is thrown if we replace a non-existent subject.
     */
    public function testReplaceSubjectNotRegistered()
    {
        $subject = new Subject();

        $this->setExpectedException(
            'Phine\\Observer\\Exception\\CollectionException',
            'The "test" subject unique identifier is not in use.'
        );

        $this->collection->replaceSubject('test', $subject);
    }

    /**
     * Make sure that we can unregister a subject.
     */
    public function testUnregisterSubject()
    {
        Property::set($this->collection, 'subjects', array('test' =>  new Subject()));

        $this->collection->unregisterSubject('test');

        $this->assertSame(
            array(),
            Property::get($this->collection, 'subjects'),
            'Make sure the "test" subject is unregistered.'
        );
    }

    /**
     * Make sure an exception is thrown if we unregister an unregistered subject.
     */
    public function testUnregisterSubjectNotRegistered()
    {
        $this->setExpectedException(
            'Phine\\Observer\\Exception\\CollectionException',
            'The "test" subject unique identifier is not in use.'
        );

        $this->collection->unregisterSubject('test');
    }

    /**
     * Make sure that we can trigger an update on a subject.
     */
    public function testUpdateSubject()
    {
        $observer = new Observer();
        $subject = new Subject();

        $subject->registerObserver($observer);

        Property::set($this->collection, 'subjects', array('test' => $subject));

        $this->collection->updateSubject('test');

        $this->assertNotNull(
            $observer->subject,
            'Make sure that observers are updated.'
        );
    }

    /**
     * Make sure that an exception is thrown when updating unregistered subjects.
     */
    public function testUpdateSubjectNotRegistered()
    {
        $this->setExpectedException(
            'Phine\\Observer\\Exception\\CollectionException',
            'The "test" subject unique identifier is not in use.'
        );

        $this->collection->updateSubject('test');
    }

    /**
     * Creates a new collection to test.
     */
    protected function setUp()
    {
        $this->collection = new Collection();
    }
}
