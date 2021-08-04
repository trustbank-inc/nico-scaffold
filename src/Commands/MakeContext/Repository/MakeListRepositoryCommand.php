<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Repository;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Seasalt\NicoScaffold\Components\StubsFindable;
use Symfony\Component\Console\Input\InputArgument;

/**
 * 一覧リポジトリのひな型のmakeコマンド
 */
final class MakeListRepositoryCommand extends GeneratorCommand
{
    use StubsFindable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:list-repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new list repository interface';

    /**
     * @var string
     */
    protected $type = 'ListRepository';

    /**
     * @return string
     */
    protected function getStub(): string
    {
        return $this->resolveStubPath('repository/list-repository.interface.stub');
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
        return $this->getEntityInput() . 'ListRepository';
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
     * 処理に成功したらImplementsとModelの作成処理も実行する
     *
     * @throws FileNotFoundException
     */
    public function handle(): bool
    {
        $result = parent::handle();
        if ($result === false) {
            return false;
        }

        $this->call('make:search-repository', $this->arguments());
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
        $stub = $this->replaceEntity($stub);
        return $this->replaceModel($stub);
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

    /**
     * @param string $stub
     * @return string
     */
    private function replaceModel(string $stub): string
    {
        return str_replace(['{{ model }}', '{{model}}'], $this->getModelInput(), $stub);
    }
}
