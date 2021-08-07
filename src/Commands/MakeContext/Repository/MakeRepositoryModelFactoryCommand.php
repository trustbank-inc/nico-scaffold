<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Repository;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Str;
use Seasalt\NicoScaffold\Components\StubsFindable;
use Symfony\Component\Console\Input\InputArgument;

/**
 * EloquentModelFactoryのmakeコマンド
 */
final class MakeRepositoryModelFactoryCommand extends GeneratorCommand
{
    use StubsFindable;

    /**
     * @var string
     */
    protected $name = 'make:repository-model-factory';

    /**
     * @var string
     */
    protected $description = 'Create a new eloquent model factory';

    /**
     * @var string
     */
    protected $type = 'Repository eloquent model factory';

    /**
     * @return string
     */
    protected function getStub(): string
    {
        return $this->resolveStubPath('repository/repository.model-factory.stub');
    }

	/**
	 * @param string $name
	 * @return string
	 */
	protected function getPath($name): string
	{
		$name = Str::replaceFirst($this->rootNamespace(), '', $name);

		return base_path('database/factories').str_replace('\\', '/', $name).'.php';
	}

	/**
	 * @return string
	 */
	protected function rootNamespace(): string
	{
		return "Database\\Factories";
	}

    /**
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace;
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
        return $this->getModelInput() . 'Factory';
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
}
