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
 * | Version: v1.0.0  Date:2019-05-19 Time:12:58
 * +----------------------------------------------------------------------
 */

namespace Hongyukeji\LaravelSettings;

use Hongyukeji\LaravelSettings\Settings\Console\SettingsTableCommand;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/settings.php' => config_path('settings.php'),
        ], 'config');
    }

    public function register()
    {
        $this->registerCommands();
    }

    /**
     * Register the settings related console commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->app->singleton('command.settings:create-table', function ($app) {
            return new SettingsTableCommand($app['files'], $app['composer']);
        });

        $this->commands('command.settings:create-table');
    }
}