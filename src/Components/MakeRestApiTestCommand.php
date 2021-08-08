<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Components;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

/**
 * REST APIテストmakeコマンド
 *
 * @note 各APIテストのmakeコマンドへ派生
 */
abstract class MakeRestApiTestCommand extends GeneratorCommand
{
    use StubsFindable;

    /**
     * @return string
     */
    abstract protected function getUseCase(): string;

    /**
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        $useCase = Str::snake($this->getUseCase());

        $this->name = "make:api-test-{$useCase}";
        $this->description = "Create a new api test ({$useCase})";
        $this->type = "ApiTest({$useCase})";

        parent::__construct($files);
    }

    /**
     * @return string
     */
    protected function getStub(): string
    {
        $useCase = Str::snake($this->getUseCase());
        $filename = 'test.api.stub';
        return $this->resolveStubPath("controller/{$useCase}/{$filename}");
    }

	/**
	 * @param string $name
	 * @return string
	 */
	protected function getPath($name): string
	{
		$name = Str::replaceFirst($this->rootNamespace(), '', $name);

		return base_path('tests').str_replace('\\', '/', $name).'.php';
	}

	/**
	 * @return string
	 */
	protected function rootNamespace(): string
	{
		return 'Tests';
	}

    /**
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
		return "{$rootNamespace}\\Feature\\{$this->getContextInput()}\\{$this->getEntityInput()}\\Api";
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
        return $this->getUseCase() . 'Test';
    }

    /**
     * @return string
     */
    protected function getEntityInput(): string
    {
        return trim($this->argument('entity'));
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
    protected function getUriInput(): string
    {
        return Str::plural(Str::snake($this->getEntityInput()));
    }

	/**
	 * @return string
	 */
	protected function getModelInput(): string
	{
		if (empty($this->argument('model'))) {
			return trim($this->argument('entity'));
		} else {
			return trim($this->argument('model'));
		}
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
		$stub = $this->replaceUri($stub);
        return $this->replaceModel($stub);
    }

    /**
     * @param string $stub
     * @return string
     */
    protected function replaceContext(string $stub): string
    {
        return str_replace(['{{ context }}', '{{context}}'], $this->getContextInput(), $stub);
    }

    /**
     * @param string $stub
     * @return string
     */
    protected function replaceEntity(string $stub): string
    {
        return str_replace(['{{ entity }}', '{{entity}}'], $this->getEntityInput(), $stub);
    }

    /**
     * @param string $stub
     * @return string
     */
    private function replaceUri(string $stub): string
    {
        return str_replace(['{{ uri }}', '{{uri}}'], $this->getUriInput(), $stub);
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
