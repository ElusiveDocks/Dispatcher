<?php

namespace ElusiveDocks\Dispatcher\Test;

use ElusiveDocks\Dispatcher\Source\Event\GenericEvent;
use PHPUnit\Framework\TestCase;

/**
 * Class GenericEventTest
 * @package ElusiveDocks\Dispatcher\Test
 */
class GenericEventTest extends TestCase
{
    /** @var null|GenericEvent $Probe */
    protected $Probe = null;

    private $dataArguments;
    private $dataSubject;

    /**
     * @expectedException \InvalidArgumentException
     * @codeCoverageIgnore
     */
    public function testGetArgumentException()
    {
        $this->Probe->getArgument('nameNotExist');
    }

    public function testGetArguments()
    {
        $this->assertSame($this->dataArguments, $this->Probe->getArguments());
    }

    public function test__construct()
    {
        $this->assertEquals($this->Probe, new GenericEvent(
            $this->dataSubject, $this->dataArguments
        ));
    }

    public function testGetSubject()
    {
        $this->assertSame($this->dataSubject, $this->Probe->getSubject());
        $this->assertInstanceOf(get_class($this->dataSubject), $this->Probe->getSubject());
    }

    public function testStopPropagation()
    {
        $this->Probe->stopPropagation();
        $this->assertTrue($this->Probe->isPropagationStopped());
    }

    public function testSetArgument()
    {
        $result = $this->Probe->setArgument('foo', 'bar');
        $this->assertAttributeSame(array_merge($this->dataArguments, ['foo' => 'bar']), 'arguments', $this->Probe);
        $this->assertSame($this->Probe, $result);
    }

    public function testIsPropagationStopped()
    {
        $this->assertFalse($this->Probe->isPropagationStopped());
    }

    public function testGetArgument()
    {
        $this->assertEquals('value', $this->Probe->getArgument('key'));
    }

    public function testHasArgument()
    {
        $this->assertTrue($this->Probe->hasArgument('key'));
        $this->assertFalse($this->Probe->hasArgument('nameNotExist'));
    }

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        $this->dataArguments = ['key' => 'value'];
        $this->dataSubject = new \stdClass();

        $this->Probe = new GenericEvent(
            $this->dataSubject, $this->dataArguments
        );
    }

    /**
     * @inheritDoc
     */
    protected function tearDown()
    {
        $this->Probe = null;
    }
}
