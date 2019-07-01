<?php namespace Hongyukeji\LaravelSettings\Providers;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Hongyukeji\LaravelSettings\Console\SettingsTableCommand;
use Hongyukeji\LaravelSettings\Factory;
use Hongyukeji\LaravelSettings\Settings;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @param \Hongyukeji\LaravelSettings\Settings $settings
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Illuminate\Contracts\Events\Dispatcher $dispatcher
     */
    public function boot(Settings $settings, Repository $config, Dispatcher $dispatcher)
    {
        $this->publishes([
            __DIR__ . '/../../../config/settings.php' => config_path('settings.php'),
        ], 'config');

        $override = $config->get('settings.override', []);

        $dispatcher->listen(
            'settings.override: app.timezone',
            function ($configKey, $configValue, $settingKey, $settingValue) {
                date_default_timezone_set($settingValue);
            }
        );

        if (count($override) > 0) {
            try {
                $this->overrideConfig($override, $config, $settings, $dispatcher);
            } catch (\Exception $e) {
            }
        }
    }

    /**
     * Override give config values from persistent setting storage.
     *
     * @param array $override
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Hongyukeji\LaravelSettings\Settings $settings
     * @param \Illuminate\Contracts\Events\Dispatcher $dispatcher
     */
    protected function overrideConfig(array $override, Repository $config, Settings $settings, Dispatcher $dispatcher)
    {
        foreach ($override as $key => $settingKey) {
            $configKey = is_string($key) ? $key : $settingKey;

            $dispatcher->dispatch("settings.overriding: {$configKey}", [$configKey, $settingKey]);

            $settingValue = $settings->get($settingKey);
            $configValue = $config->get($configKey);

            if (config('settings.array_filter_null_value', false)) {
                $mergeValue = array_replace_recursive($configValue ?: [], array_filter_recursive($settingValue));
            } else {
                $mergeValue = array_replace_recursive($configValue ?: [], $settingValue);
            }

            $config->set($configKey, $mergeValue);

            $dispatcher->dispatch("settings.override: {$configKey}", [
                $configKey, $configValue, $settingKey, $mergeValue
            ]);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../../config/settings.php', 'settings');

        $this->app->singleton('settings.key_generator', function ($app) {
            return $app->make($app['config']['settings.key_generator']);
        });

        $this->app->singleton('settings.context_serializer', function ($app) {
            return $app->make($app['config']['settings.context_serializer']);
        });

        $this->app->singleton('settings.value_serializer', function ($app) {
            return $app->make($app['config']['settings.value_serializer']);
        });

        $this->app->singleton('settings.factory', function ($app) {
            return new Factory($app);
        });

        $this->app->singleton('settings.repository', function ($app) {
            return $app['settings.factory']->driver();
        });

        $this->app->singleton('settings', function ($app) {
            $settings = new Settings(
                $app['settings.repository'],
                $app['settings.key_generator'],
                $app['settings.value_serializer']
            );

            $settings->setCache($app['cache.store']);
            $settings->setEncrypter($app['encrypter']);
            $settings->setDispatcher($app['events']);

            $app['config']['settings.cache'] ? $settings->enableCache() : $settings->disableCache();
            $app['config']['settings.encryption'] ? $settings->enableEncryption() : $settings->disableEncryption();
            $app['config']['settings.events'] ? $settings->enableEvents() : $settings->disableEvents();

            return $settings;
        });

        $this->registerAliases();

        $this->registerCommands();
    }

    /**
     * Register aliases.
     *
     * @return void
     */
    protected function registerAliases()
    {
        $this->app->alias('settings.factory', 'Hongyukeji\LaravelSettings\Contracts\Factory');

        $this->app->alias('settings.repository', 'Hongyukeji\LaravelSettings\Contracts\Repository');

        $this->app->alias('settings.key_generator', 'Hongyukeji\LaravelSettings\Contracts\KeyGenerator');

        $this->app->alias('settings.context_serializer', 'Hongyukeji\LaravelSettings\Contracts\ContextSerializer');

        $this->app->alias('settings.value_serializer', 'Hongyukeji\LaravelSettings\Contracts\ValueSerializer');

        $this->app->alias('settings', 'Hongyukeji\LaravelSettings\Settings');
    }

    /**
     * Register the settings related console commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->app->singleton('command.settings.table', function ($app) {
            return new SettingsTableCommand($app['files'], $app['composer']);
        });

        $this->commands('command.settings.table');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'settings',
            'settings.repository',
            'settings.factory',
            'settings.key_generator',
            'settings.context_serializer',
            'command.settings.table',
        ];
    }
}
