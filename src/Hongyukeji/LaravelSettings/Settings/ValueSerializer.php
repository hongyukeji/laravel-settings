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
 * | Version: v1.0.0  Date:2019-05-19 Time:12:35
 * +----------------------------------------------------------------------
 */

namespace Hongyukeji\LaravelSettings\Settings;

use Hongyukeji\LaravelSettings\Contracts\ValueSerializer as ValueSerializerContract;

class ValueSerializer implements ValueSerializerContract
{
    /**
     * Serialize value.
     *
     * @param mixed $value
     * @return mixed
     */
    public function serialize($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Unserialize value.
     *
     * @param mixed $serialized
     * @return mixed
     */
    public function unserialize($serialized)
    {
        return json_decode($serialized, true);
    }
}
