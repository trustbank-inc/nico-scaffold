<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold;

use Illuminate\Console\Application as Artisan;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionException;
use Seasalt\NicoScaffold\Components\Domain\Entity\IdGenerator;
use Seasalt\NicoScaffold\Components\Domain\Entity\IdGeneratorImpl;
use Symfony\Component\Finder\Finder;

/**
 * 各コンテキストのサービスを登録する
 */
final class ContextServiceProvider extends ServiceProvider
{
    /**
     * コマンドにより生成されたサービスをロードする
     */
    public function register(): void
    {
        $this->app->bind(IdGenerator::class, IdGeneratorImpl::class);

        $namespace = "App\\";
        foreach (glob(app_path('Providers/Contexts/*')) as $contextDirectory) {
            foreach (glob("{$contextDirectory}/*ServiceProvider.php") as $providerPath) {
                $providerName = $namespace . str_replace(
                        ['/', '.php'],
                        ['\\', ''],
                        Str::after($providerPath, app_path() . DIRECTORY_SEPARATOR)
                    );
                $provider = $this->app->resolveProvider($providerName);
                $provider->register();
            }
        }
    }

    /**
     * コマンドにより生成された設定ファイルをロードする
     *
     * @throws ReflectionException
     */
    public function boot(): void
    {
        // ルーティング
        foreach (glob(base_path('routes/contexts/*'), GLOB_ONLYDIR) as $context) {
            foreach (glob("{$context}/*", GLOB_ONLYDIR) as $entity) {
                foreach (glob("{$entity}/*.php") as $routes) {
                    $this->loadRoutesFrom($routes);
                }
				foreach (glob("{$entity}/api/*.php") as $routes) {
					$this->loadRoutesFrom($routes);
				}
            }
        }

        // コマンド
        if ($this->app->runningInConsole()) {
            $this->loadCommands(__DIR__ . '/Commands');
        }

        // スタブ
        $this->publishes(
            paths: [
                dirname(__DIR__).'/stubs' => base_path('stubs'),
            ],
            groups: 'nico-scaffold'
        );
    }

    /**
     * artisanコマンドを登録する
     *
     * @param array|string $paths
     * @throws ReflectionException
     */
    protected function loadCommands(string|array $paths): void
    {
        $paths = array_unique(Arr::wrap($paths));

        $paths = array_filter($paths, function ($path) {
            return is_dir($path);
        });

        if (empty($paths)) {
            return;
        }

        $namespace = "Seasalt\\NicoScaffold\\";
        foreach ((new Finder)->in($paths)->files() as $command) {
            $command = $namespace . str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    Str::after($command->getRealPath(), realpath(__DIR__).DIRECTORY_SEPARATOR)
                );

            if (is_subclass_of($command, Command::class) &&
                ! (new ReflectionClass($command))->isAbstract()) {
                Artisan::starting(function ($artisan) use ($command) {
                    $artisan->resolve($command);
                });
            }
        }
    }
}
