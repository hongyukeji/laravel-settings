<?php

use Mockery as m;

class ContextSerializerTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testSetContextArgument()
    {
        $context = new \Hongyukeji\LaravelSettings\Context();
        $context->set('a', 'a');

        $serializer = new \Hongyukeji\LaravelSettings\ContextSerializers\ContextSerializer();

        $this->assertEquals(serialize($context), $serializer->serialize($context));
    }

    public function testSerializeNull()
    {
        $serializer = new \Hongyukeji\LaravelSettings\ContextSerializers\ContextSerializer();

        $this->assertEquals(serialize(null), $serializer->serialize(null));
    }
}
