<?php

if (!function_exists('settings')) {
    /**
     * Get / set the specified setting value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param array|string $key
     * @param mixed $default
     * @param null $context
     * @return mixed
     */
    function settings($key = null, $default = null, $context = null)
    {
        $settings = app('settings');

        if (is_null($key)) {
            return $settings;
        }

        if (is_array($key)) {
            foreach ($key as $k => $v) {
                if ($default instanceof \Hongyukeji\LaravelSettings\Context) {
                    $settings->context($default);
                }
                $settings->set($k, $v);
            }
            return true;
        }

        if ($context instanceof \Hongyukeji\LaravelSettings\Context) {
            $settings->context($context);
        }

        return $settings->get($key, $default);
    }
}

if (!function_exists('array_filter_recursive')) {

    /**
     * array_filter_recursive 清除多维数组里面的空值
     * @param array $arr
     * @return array
     * @author   liuml
     * @DateTime 2018/12/3  11:27
     */
    function array_filter_recursive(array &$arr)
    {
        if (count($arr) < 1) {
            return [];
        }
        foreach ($arr as $k => $v) {
            if (is_array($v)) {
                $arr[$k] = array_filter_recursive($v);
            }
            if (is_null($arr[$k]) && $arr[$k] == '') {
                unset($arr[$k]);
            }
        }
        return $arr;
    }
}

if (!function_exists('san_config_dir_files')) {
    /*
     * 扫描配置文件目录中所有文件
     */
    function san_config_dir_files($path = '', $cut_suffix = '.php')
    {
        $path or $path = config_path();
        $override = [];
        foreach (array_diff(scandir(config_path()), ['.', '..']) as $file) {
            $config_key = substr($file, 0, strpos($file, $cut_suffix));
            $override[$config_key] = $config_key;
        }
        return $override;
    }
}