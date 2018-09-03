<?php

namespace ElusiveDocks\BackBone\Test;

use ElusiveDocks\BackBone\Exception\GenericException;
use PHPUnit\Framework\TestCase;

/**
 * Class GenericExceptionTest
 * @package ElusiveDocks\BackBone\Test\Exception
 */
class GenericExceptionTest extends TestCase
{
    /** @var null|GenericException $Probe */
    protected $Probe = null;

    private $dataCode;
    private $dataMessage;
    private $dataThrowable;

    public function test__toString()
    {
        $this->assertInstanceOf(\Throwable::class, $this->Probe);
        $this->assertInstanceOf(\Exception::class, $this->Probe);

        $this->assertInternalType('string', (string)$this->Probe);

        $this->assertEquals($this->dataMessage, $this->Probe->getMessage());
        $this->assertEquals($this->dataCode, $this->Probe->getCode());
        $this->assertEquals($this->dataThrowable, $this->Probe->getPrevious());
    }

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        $this->dataThrowable = new \Exception();
        $this->dataMessage = 'message';
        $this->dataCode = 1;

        $this->Probe = new GenericException($this->dataMessage, $this->dataCode, $this->dataThrowable);
    }

    /**
     * @inheritDoc
     */
    protected function tearDown()
    {
        $this->Probe = null;
    }
}
