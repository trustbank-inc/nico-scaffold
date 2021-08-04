<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Seasalt\NicoScaffold\Components\StubsFindable;
use Symfony\Component\Console\Input\InputArgument;

/**
 * REST操作コントローラmakeコマンド
 *
 * @note 各コントローラのmakeコマンドへ派生
 */
abstract class MakeRestControllerCommand extends GeneratorCommand
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

        $this->name = "make:controller-{$useCase}";
        $this->description = "Create a new controller ({$useCase})";
        $this->type = "Controller({$useCase})";

        parent::__construct($files);
    }

    /**
     * @return string
     */
    protected function getStub(): string
    {
        $useCase = Str::snake($this->getUseCase());
        return $this->resolveStubPath("controller/{$useCase}/controller.stub");
    }

    /**
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . "\\Http\\Controllers\\{$this->getContextInput()}";
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
     * @return string
     */
    protected function getNameInput(): string
    {
        return $this->getEntityInput() . $this->getUseCase() . 'Controller';
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
    protected function getUriInput(): string
    {
        return Str::plural(Str::snake($this->getEntityInput()));
    }

    /**
     * 処理に成功したらRequestの作成処理も実行する
     *
     * @throws FileNotFoundException
     */
    public function handle(): bool
    {
        $result = parent::handle();
        if ($result === false) {
            return false;
        }

        $this->call($this->name . '-request', $this->arguments());
        $this->call($this->name . '-route', $this->arguments());
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
        return $this->replaceUri($stub);
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
}
