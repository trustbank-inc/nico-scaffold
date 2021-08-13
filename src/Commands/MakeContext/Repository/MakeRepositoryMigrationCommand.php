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
final class MakeRepositoryMigrationCommand extends GeneratorCommand
{
    use StubsFindable;

    /**
     * @var string
     */
    protected $name = 'make:repository-migration';

    /**
     * @var string
     */
    protected $description = 'Create a new migration for repository';

    /**
     * @var string
     */
    protected $type = 'Repository migration';

    /**
     * @return string
     */
    protected function getStub(): string
    {
        return $this->resolveStubPath('repository/repository.migration.stub');
    }

    /**
     * @param string $name
     * @return string
     */
    protected function getPath($name): string
    {
        return base_path("database/migrations/contexts/{$this->getNameInput()}");
    }

    /**
     * @return array
     */
    protected function getArguments(): array
    {
        return [
            ['context', InputArgument::REQUIRED, 'The context for this Repository'],
            ['entity', InputArgument::REQUIRED, 'The name of target entity'],
            ['model', InputArgument::OPTIONAL, 'The name of eloquent model'],
        ];
    }

    /**
     * @return string
     */
    protected function getNameInput(): string
    {
        $context = Str::snake($this->getContextInput());
        $model = Str::snake(Str::plural($this->getModelInput()));
        return "{$context}_{$model}_table.php";
    }

    /**
     * @return string
     */
    protected function getEntityInput(): string
    {
        return trim($this->argument('entity'));
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
        return trim($this->argument('model') ?? $this->argument('entity'));
    }

    /**
     * @param string $name
     * @return string
     * @throws FileNotFoundException
     */
    protected function buildClass($name): string
    {
        $stub = parent::buildClass($name);
        return $this->replaceTable($stub);
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
