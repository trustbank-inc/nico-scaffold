<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Entity;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Seasalt\NicoScaffold\Components\StubsFindable;
use Symfony\Component\Console\Input\InputArgument;

/**
 * エンティティのひな型のmakeコマンド
 */
final class MakeEntityCommand extends GeneratorCommand
{
    use StubsFindable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:entity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new entity';

    /**
     * @var string
     */
    protected $type = 'Entity';

    /**
     * @return string
     */
    protected function getStub(): string
    {
        return $this->resolveStubPath('entity/entity.stub');
    }

    /**
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . "\\Contexts\\{$this->getContextInput()}\\Domain\\Entity";
    }

    /**
     * @return array
     */
    protected function getArguments(): array
    {
        return [
            ['context', InputArgument::REQUIRED, 'The context for this Entity'],
            ['entity', InputArgument::REQUIRED, 'The name of this Entity'],
            ['model', InputArgument::OPTIONAL, 'The name of eloquent model'],
        ];
    }

    /**
     * @return string
     */
    protected function getNameInput(): string
    {
        return $this->getEntityInput();
    }

    /**
     * @return string
     */
    protected function getContextInput(): string
    {
        return trim($this->argument('context'));
    }

    /**
     * @return string
     */
    protected function getEntityInput(): string
    {
        return trim($this->argument('entity'));
    }

    /**
     * 処理に成功したらIDとRepositoryの作成処理も実行する
     *
     * @throws FileNotFoundException
     */
    public function handle(): bool
    {
        $result = parent::handle();

        $params = [
            'context' => $this->getContextInput(),
            'entity' => $this->getEntityInput(),
        ];
        $this->call('make:entity-id', $params);
        $this->call('make:entity-list', $params);
        $this->call('make:entity-field', $params + [
            'name' => 'Title',
            'type' => 'String',
        ]);
        $params['model'] = $this->argument('model');
        $this->call('make:repository', $params);
        $this->call('make:list-repository', $params);
        return true;
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
