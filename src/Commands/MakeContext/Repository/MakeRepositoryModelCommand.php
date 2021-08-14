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
            ['context', InputArgument::REQUIRED, 'The context for this Repository'],
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
     * Get the desired context from the input.
     *
     * @return string
     */
    protected function getContextInput(): string
    {
        return trim($this->argument('context'));
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
        $stub = $this->replaceModel($stub);
        return $this->replaceTable($stub);
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
     * @param string $stub
     * @return string
     */
    private function replaceTable(string $stub): string
    {
        $context = Str::snake($this->getContextInput());
        $table = Str::snake(Str::plural($this->getModelInput()));
        return str_replace(['{{ table }}', '{{table}}'], "{$context}_{$table}", $stub);
    }
}
