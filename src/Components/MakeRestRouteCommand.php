<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Components;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * REST操作ルートmakeコマンド
 *
 * @note 各ルートのmakeコマンドへ派生
 */
abstract class MakeRestRouteCommand extends GeneratorCommand
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

        $this->name = "make:controller-{$useCase}-route";
        $this->description = "Create a new controller route ({$useCase})";
        $this->type = "Route({$useCase})";

        parent::__construct($files);
    }

    /**
     * @return string
     */
    protected function getStub(): string
    {
        $useCase = Str::snake($this->getUseCase());
		$filename = 'route.stub';
		if ($this->option('api')) {
			$filename = 'route.api.stub';
		}
        return $this->resolveStubPath("controller/{$useCase}/{$filename}");
    }

    /**
     * @param string $name
     * @return string
     */
    protected function getPath($name): string
    {
        $context = Str::snake($this->getContextInput());
        $entity = Str::snake($this->getEntityInput());
        $useCase = Str::snake($this->getUseCase());
        if ($this->option('api')) {
			return base_path("routes/contexts/{$context}/{$entity}/api/{$useCase}.php");
		} else {
			return base_path("routes/contexts/{$context}/{$entity}/{$useCase}.php");
		}
    }

    /**
     * @return array
     */
    protected function getArguments(): array
    {
        return [
            ['context', InputArgument::REQUIRED, 'The context for this Repository'],
            ['entity', InputArgument::REQUIRED, 'The name of target entity'],
        ];
    }

	/**
	 * @return array
	 */
	protected function getOptions(): array
	{
		return [
			['api', 'a', InputOption::VALUE_NONE, 'API mode option'],
		];
	}

    /**
     * @return string
     */
    protected function getNameInput(): string
    {
        return $this->getEntityInput() . 'ListPageController';
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
     * @param string $name
     * @return string
     * @throws FileNotFoundException
     */
    protected function buildClass($name): string
    {
        $stub = parent::buildClass($name);
        $stub = $this->replaceContext($stub);
        $stub = $this->replaceEntity($stub);
        $stub = $this->replaceResource($stub);
        return $this->replacePrefix($stub);
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
    protected function replaceResource(string $stub): string
    {
        $resource = Str::snake(Str::plural($this->getEntityInput()));
        return str_replace(['{{ resource }}', '{{resource}}'], $resource, $stub);
    }

    /**
     * @param string $stub
     * @return string
     */
    protected function replacePrefix(string $stub): string
    {
        $prefix = Str::snake($this->getContextInput());
        return str_replace(['{{ prefix }}', '{{prefix}}'], $prefix, $stub);
    }
}
