<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Repository;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Seasalt\NicoScaffold\Components\StubsFindable;
use Symfony\Component\Console\Input\InputArgument;

/**
 * リポジトリレコードのひな型のmakeコマンド
 */
final class MakeRepositoryRecordCommand extends GeneratorCommand
{
    use StubsFindable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:repository-record';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository record interface';

    /**
     * @var string
     */
    protected $type = 'RepositoryRecord';

    /**
     * @return string
     */
    protected function getStub(): string
    {
        return $this->resolveStubPath('repository/repository.record.stub');
    }

    /**
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . "\\Contexts\\{$this->getContextInput()}\\Domain\\Persistence";
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
        return $this->getEntityInput() . 'RepositoryRecord';
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
     * @param string $name
     * @return string
     * @throws FileNotFoundException
     */
    protected function buildClass($name): string
    {
        $stub = parent::buildClass($name);
        $stub = $this->replaceContext($stub);
        return $this->replaceEntity($stub);
    }

    /**
     * @param string $stub
     * @return string
     */
    private function replaceContext(string $stub): string
    {
        return str_replace(['{{ context }}', '{{context}}'], $this->getContextInput(), $stub);
    }

    /**
     * @param string $stub
     * @return string
     */
    private function replaceEntity(string $stub): string
    {
        return str_replace(['{{ entity }}', '{{entity}}'], $this->getEntityInput(), $stub);
    }
}
