<?php
/**
 * +----------------------------------------------------------------------
 * | laravel-settings [ File Description ]
 * +----------------------------------------------------------------------
 * | Copyright (c) 2015~2019 http://www.wmt.ltd All rights reserved.
 * +----------------------------------------------------------------------
 * | 版权所有：贵州鸿宇叁柒柒科技有限公司
 * +----------------------------------------------------------------------
 * | Author: shadow <admin@hongyuvip.com>  QQ: 1527200768
 * +----------------------------------------------------------------------
 * | Version: v1.0.0  Date:2019-05-19 Time:12:32
 * +----------------------------------------------------------------------
 */

namespace Hongyukeji\LaravelSettings\Settings;

use Krucas\Settings\Context;
use Krucas\Settings\Contracts\ContextSerializer;
use Krucas\Settings\Contracts\KeyGenerator as KeyGeneratorContract;

class KeyGenerator implements KeyGeneratorContract
{
    /**
     * Context serializer.
     *
     * @var \Krucas\Settings\Contracts\ContextSerializer
     */
    protected $serializer;

    /**
     * @param \Krucas\Settings\Contracts\ContextSerializer $serializer
     */
    public function __construct(ContextSerializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * Generate storage key for a given key and context.
     *
     * @param string $key
     * @param \Krucas\Settings\Context $context
     * @return string
     */
    public function generate($key, Context $context = null)
    {
        return $key . $this->serializer->serialize($context);
    }
}
