<?php

namespace Phine\Observer\Tests;

use Phine\Observer\Exception\ReasonException;
use Phine\Observer\Subject;
use Phine\Observer\Test\Observer;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Tests the methods for the {@link Subject} class.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class SubjectTest extends TestCase
{
    /**
     * The subject to test.
     *
     * @var Subject
     */
    private $subject;

    /**
     * Make sure that we can check if an observer is registered.
     */
    public function testHasObserver()
    {
        $observer = new Observer();

        $this->assertFalse(
            $this->subject->hasObserver($observer),
            'Make sure we do not find the observer in a new subject.'
        );

        set($this->subject, 'observers', array(array($observer)));

        $this->assertTrue(
            $this->subject->hasObserver($observer),
            'Make sure we can confirm that an observer is registered.'
        );

        $this->assertFalse(
            $this->subject->hasObserver($observer, 123),
            'Make sure that using a different priority returns false.'
        );

        $this->assertTrue(
            $this->subject->hasObserver($observer, 0),
            'Make sure that using the same priority returns true.'
        );
    }

    /**
     * Make sure that we can check if any observer is registered.
     */
    public function testHasObservers()
    {
        set($this->subject, 'observers', array(123 => array()));

        $this->assertFalse(
            $this->subject->hasObservers(),
            'Make sure that no observers are registered with a new subject.'
        );

        set($this->subject, 'observers', array(123 => array(new Observer())));

        $this->assertTrue(
            $this->subject->hasObservers(),
            'Make sure that checking any priority returns true if registered.'
        );

        $this->assertFalse(
            $this->subject->hasObservers(0),
            'Make sure that unused priorities return false.'
        );

        $this->assertTrue(
            $this->subject->hasObservers(123),
            'Make sure that used priorities return true.'
        );
    }

    /**
     * Make sure that we can interrupt an update.
     */
    public function testInterruptUpdate()
    {
        $this->subject->interruptUpdate();

        $this->assertEquals(
            '(no reason specified)',
            get($this->subject, 'reason')->getMessage(),
            'Make sure that a default reason is used if none is given.'
        );

        $reason = new ReasonException('Just testing.');

        $this->subject->interruptUpdate($reason);

        $this->assertSame(
            $reason,
            get($this->subject, 'reason'),
            'Make sure that we can use our own reason for interrupting.'
        );
    }

    /**
     * Make sure that we can notify all registered observers.
     */
    public function testNotifyObservers()
    {
        Observer::$counter = 0;

        $observers = array(
            array(new Observer(), 2),
            array(new Observer(), 0),
            array(new Observer(), 1),
        );

        set(
            $this->subject,
            'observers',
            array(
                0 => array($observers[1][0]),
                123 => array($observers[2][0], $observers[0][0]),
            )
        );

        $this->subject->notifyObservers();

        foreach ($observers as $i => $observer) {
            $this->assertSame(
                $this->subject,
                $observer[0]->subject,
                "Make sure that observer #$i has the same subject."
            );

            $this->assertEquals(
                $observer[1],
                $observer[0]->order,
                "Make sure that observer #$i is called {$observer[1]}st/rd/th."
            );
        }

        $observers = array(
            array(new Observer(), null),
            array(new Observer(), 3),
            array(new Observer(true), 4),
        );

        set(
            $this->subject,
            'observers',
            array(
                0 => array($observers[1][0]),
                123 => array($observers[2][0], $observers[0][0]),
            )
        );

        try {
            $this->subject->notifyObservers();
        } catch (ReasonException $reason) {
        }

        foreach ($observers as $i => $observer) {
            $this->assertEquals(
                $observer[1],
                $observer[0]->order,
                "Make sure that observer #$i is called {$observer[1]}st/rd/th or not at all."
            );
        }

        $this->assertTrue(
            isset($reason),
            'Make sure that the update was interrupted.'
        );
    }

    /**
     * Make sure that we can register an observer.
     */
    public function testRegisterObserver()
    {
        $observer = new Observer();

        $this->subject->registerObserver($observer);

        $this->assertEquals(
            array(
                0 => array($observer)
            ),
            get($this->subject, 'observers'),
            'Make sure the observer is registered as zero priority.'
        );

        $this->subject->registerObserver($observer, 123);

        $this->assertEquals(
            array(
                0 => array($observer),
                123 => array($observer)
            ),
            get($this->subject, 'observers'),
            'Make sure that the observer is registered with priority 123.'
        );
    }

    /**
     * Make sure that we can unregister all observers.
     */
    public function testUnregisterAllObservers()
    {
        $observers = array(
            new Observer(),
            new Observer(),
            new Observer(),
        );

        set(
            $this->subject,
            'observers',
            array(
                0 => array($observers[0], $observers[1]),
                123 => array($observers[0], $observers[1], $observers[2], $observers[1]),
                456 => array($observers[2], $observers[2]),
            )
        );

        $this->subject->unregisterAllObservers($observers[1], 123);

        $this->assertSame(
            array(
                0 => array($observers[0], $observers[1]),
                123 => array($observers[0], 2 => $observers[2]),
                456 => array($observers[2], $observers[2]),
            ),
            get($this->subject, 'observers'),
            'Make sure that all of a single observer is unregistered in a specific priority.'
        );

        $this->subject->unregisterAllObservers($observers[2]);

        $this->assertSame(
            array(
                0 => array($observers[0], $observers[1]),
                123 => array($observers[0]),
                456 => array(),
            ),
            get($this->subject, 'observers'),
            'Make sure that all of a single observer is unregistered for any priority.'
        );

        $this->subject->unregisterAllObservers(null, 0);

        $this->assertSame(
            array(
                123 => array($observers[0]),
                456 => array(),
            ),
            get($this->subject, 'observers'),
            'Make sure that all observers of a single priority are unregistered.'
        );

        $this->subject->unregisterAllObservers();

        $this->assertSame(
            array(),
            get($this->subject, 'observers'),
            'Make sure that all observers are unregistered.'
        );
    }

    /**
     * Make sure that we can unregister a single occurrences of an observer.
     */
    public function testUnregisterObserver()
    {
        $observers = array(
            new Observer(),
            new Observer(),
            new Observer(),
        );

        set(
            $this->subject,
            'observers',
            array(
                456 => array($observers[2], $observers[2]),
                0 => array($observers[0], $observers[1]),
                123 => array($observers[0], $observers[1], $observers[2], $observers[1]),
            )
        );

        $this->subject->unregisterObserver($observers[0]);

        $this->assertSame(
            array(
                0 => array(1 => $observers[1]),
                123 => array($observers[0], $observers[1], $observers[2], $observers[1]),
                456 => array($observers[2], $observers[2]),
            ),
            get($this->subject, 'observers'),
            'Unregister the first occurrence sorted by priority.'
        );

        $this->subject->unregisterObserver($observers[2], 456);

        $this->assertSame(
            array(
                0 => array(1 => $observers[1]),
                123 => array($observers[0], $observers[1], $observers[2], $observers[1]),
                456 => array(1 => $observers[2]),
            ),
            get($this->subject, 'observers'),
            'Unregister the first occurrence for a specific priority.'
        );
    }

    /**
     * Creates a new {@link Subject} for testing.
     */
    protected function setUp()
    {
        $this->subject = new Subject();
    }
}
