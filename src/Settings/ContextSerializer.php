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
 * | Version: v1.0.0  Date:2019-05-19 Time:12:46
 * +----------------------------------------------------------------------
 */

namespace Hongyukeji\LaravelSettings\Settings;

use Hongyukeji\LaravelSettings\Context;
use Hongyukeji\LaravelSettings\Contracts\ContextSerializer as ContextSerializerContract;

class ContextSerializer implements ContextSerializerContract
{
    /**
     * Serialize context into a string representation.
     *
     * @param \Hongyukeji\LaravelSettings\Context $context
     * @return string
     */
    public function serialize(Context $context = null)
    {
        return $context ? json_encode($context, JSON_UNESCAPED_UNICODE) : '';
    }
}