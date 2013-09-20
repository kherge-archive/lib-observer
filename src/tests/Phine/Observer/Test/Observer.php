<?php

namespace Phine\Observer\Test;

use Phine\Observer\Exception\ReasonException;
use Phine\Observer\ObserverInterface;
use Phine\Observer\SubjectInterface;

/**
 * A simple test observer.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class Observer implements ObserverInterface
{
    /**
     * The order counter (must reset before update).
     *
     * @var integer
     */
    public static $counter = 0;

    /**
     * The order in which it was called.
     *
     * @var integer
     */
    public $order;

    /**
     * The reason for the interrupt.
     *
     * @var ReasonException
     */
    public $reason;

    /**
     * The subject that updated this observer.
     *
     * @var SubjectInterface
     */
    public $subject;

    /**
     * The flag used to determine if the update should be interrupted.
     *
     * @var boolean
     */
    private $interrupt;

    /**
     * Sets the interrupt flag.
     *
     * @param boolean $interrupt Interrupt the update?
     */
    public function __construct($interrupt = false)
    {
        $this->interrupt = $interrupt;
    }

    /**
     * {@inheritDoc}
     */
    public function receiveUpdate(SubjectInterface $subject)
    {
        $this->order = self::$counter++;

        $this->subject = $subject;

        if ($this->interrupt) {
            $this->reason = new ReasonException('Testing interruption.');

            $subject->interruptUpdate($this->reason);
        }
    }
}
