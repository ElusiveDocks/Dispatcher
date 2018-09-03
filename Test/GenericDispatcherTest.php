<?php

namespace ElusiveDocks\BackBone\Test;

use ElusiveDocks\BackBone\Contract\EventInterface;
use ElusiveDocks\BackBone\Source\Dispatcher\GenericDispatcher;
use ElusiveDocks\BackBone\Source\Event\GenericEvent;
use PHPUnit\Framework\TestCase;

/**
 * Class GenericDispatcherTest
 * @package ElusiveDocks\BackBone\Test
 */
class GenericDispatcherTest extends TestCase
{
    /** @var null|GenericDispatcher $Probe */
    protected $Probe = null;

    private $dataListener2;
    private $dataListener;
    private $dataEvent;

    public function testHasListeners()
    {
        $this->assertTrue($this->Probe->hasListeners('Event1'));
        $this->assertFalse($this->Probe->hasListeners('Event2'));
    }

    public function testGetListeners()
    {
        $this->assertEquals([], $this->Probe->getListeners('Event2'));
        $this->assertContains($this->dataListener, $this->Probe->getListeners('Event1'));
    }

    public function testRemoveListener()
    {
        $this->Probe->removeListener('Event1', $this->dataListener);
        $this->Probe->removeListener('Event1', $this->dataListener2);
        $this->assertEmpty($this->Probe->getListeners('Event1'));

        $this->Probe->removeListener('Event3', $this->dataListener);
    }

    public function testAddListener()
    {
        $this->Probe->addListener('Event2', $this->dataListener);
        $this->assertContains($this->dataListener, $this->Probe->getListeners('Event2'));
    }

    public function testDispatch()
    {
        $this->assertEquals($this->dataEvent, $this->Probe->dispatch('Event1', $this->dataEvent));
        $this->assertEquals($this->dataEvent, $this->Probe->dispatch('Event2', $this->dataEvent));

        $this->assertEquals(new GenericEvent(), $this->Probe->dispatch('Event3'));
    }

    /**
     * @inheritDoc
     */
    protected function setUp()
    {

        $this->dataListener = function (EventInterface $A) {
//            print 'Listener 1';
//            $A->stopPropagation();
        };

        /** @var callable dataListener2 */
        $this->dataListener2 = [__CLASS__,'dataListener2'];

        $this->dataEvent = new GenericEvent('generic', ['key' => 'value']);

        $this->Probe = new GenericDispatcher();

        $this->Probe->addListener('Event1', $this->dataListener, 4);
        $this->Probe->addListener('Event1', $this->dataListener2, 3);
        $this->Probe->addListener('Event1', $this->dataListener, 2);
        $this->Probe->addListener('Event1', $this->dataListener, 1);
    }

    /**
     * @inheritDoc
     */
    protected function tearDown()
    {
        $this->Probe = null;
    }

    /**
     * @param EventInterface $A
     */
    public static function dataListener2(EventInterface $A) {
//        print 'Listener 2';
        $A->stopPropagation();
    }
}
