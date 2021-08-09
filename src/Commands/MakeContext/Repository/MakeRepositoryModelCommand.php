<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Repository;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Str;
use Seasalt\NicoScaffold\Components\StubsFindable;
use Symfony\Component\Console\Input\InputArgument;

/**
 * リポジトリで利用するEloquentModelのmakeコマンド
 */
final class MakeRepositoryModelCommand extends GeneratorCommand
{
    use StubsFindable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:repository-model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new eloquent model for repository';

    /**
     * @var string
     */
    protected $type = 'Repository eloquent model';

    /**
     * @return string
     */
    protected function getStub(): string
    {
        return $this->resolveStubPath('repository/repository.model.stub');
    }

    /**
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . "\\Models";
    }

    /**
     * @return array
     */
    protected function getArguments(): array
    {
        return [
            ['model', InputArgument::REQUIRED, 'The name of eloquent model'],
        ];
    }

    /**
     * @return string
     */
    protected function getNameInput(): string
    {
        return $this->getModelInput();
    }

    /**
     * @return string
     */
    protected function getModelInput(): string
    {
        return trim($this->argument('model'));
    }

    /**
     * @param string $name
     * @return string
     * @throws FileNotFoundException
     */
    protected function buildClass($name): string
    {
        $stub = parent::buildClass($name);
        return $this->replaceModel($stub);
    }

    /**
     * @param string $stub
     * @return string
     */
    private function replaceModel(string $stub): string
    {
        return str_replace(['{{ model }}', '{{model}}'], $this->getModelInput(), $stub);
    }

    /**
     * 処理に成功したらImplementsとModelの作成処理も実行する
     *
     * @throws FileNotFoundException
     */
    public function handle(): bool
    {
        $result = parent::handle();

		$this->call('make:repository-model-factory', $this->arguments());
        $this->createMigration();

        return true;
    }

    /**
     *
     */
    protected function createMigration(): void
    {
        $table = Str::snake(Str::pluralStudly(class_basename($this->getModelInput())));

        $this->call('make:repository-migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
        ]);
    }
}
