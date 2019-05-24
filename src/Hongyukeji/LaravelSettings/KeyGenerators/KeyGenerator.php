<?php

namespace Hongyukeji\LaravelSettings\KeyGenerators;

use Hongyukeji\LaravelSettings\Context;
use Hongyukeji\LaravelSettings\Contracts\ContextSerializer;
use Hongyukeji\LaravelSettings\Contracts\KeyGenerator as KeyGeneratorContract;

class KeyGenerator implements KeyGeneratorContract
{
    /**
     * Context serializer.
     *
     * @var \Hongyukeji\LaravelSettings\Contracts\ContextSerializer
     */
    protected $serializer;

    /**
     * @param \Hongyukeji\LaravelSettings\Contracts\ContextSerializer $serializer
     */
    public function __construct(ContextSerializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * Generate storage key for a given key and context.
     *
     * @param string $key
     * @param \Hongyukeji\LaravelSettings\Context $context
     * @return string
     */
    public function generate($key, Context $context = null)
    {
        return md5($key.$this->serializer->serialize($context));
    }
}
