<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Entity;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Seasalt\NicoScaffold\Components\StubsFindable;
use Symfony\Component\Console\Input\InputArgument;

/**
 * エンティティIDのひな型のmakeコマンド
 */
final class MakeEntityIdCommand extends GeneratorCommand
{
    use StubsFindable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:entity-id';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new entity id';

    /**
     * @var string
     */
    protected $type = 'EntityId';

    /**
     * @return string
     */
    protected function getStub(): string
    {
        return $this->resolveStubPath('entity/entity-id.stub');
    }

    /**
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . "\\Contexts\\{$this->getContextInput()}\\Domain\\Entity\\{$this->getEntityInput()}";
    }

    /**
     * @return string
     */
    protected function getNameInput(): string
    {
        return 'Id';
    }

    /**
     * @return array
     */
    protected function getArguments(): array
    {
        return [
            ['context', InputArgument::REQUIRED, 'The context for this Entity'],
            ['entity', InputArgument::REQUIRED, 'The name of this Entity'],
        ];
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
