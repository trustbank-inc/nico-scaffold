<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Components;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

/**
 * REST操作画面のひな型のmakeコマンド
 *
 * @note 各ユースケースのmakeコマンドへ派生
 */
abstract class MakeRestViewCommand extends GeneratorCommand
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

        $this->name = "make:view-{$useCase}";
        $this->description = "Create a new view ({$useCase})";
        $this->type = "View({$useCase})";

        parent::__construct($files);
    }

    /**
     * @return string
     */
    protected function getStub(): string
    {
        $useCase = Str::snake($this->getUseCase());
        return $this->resolveStubPath("presenter/{$useCase}/view.stub");
    }

    /**
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . "\\Contexts\\{$this->getContextInput()}\\Infrastructure\\Presenter";
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
        return $this->getEntityInput() . $this->getUseCase() . 'View';
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
    protected function getTemplateInput(): string
    {
        $context = Str::snake($this->getContextInput());
        $entity = Str::snake($this->getEntityInput());
        $useCase = Str::snake($this->getUseCase());
        return "{$context}/{$entity}/{$useCase}";
    }

    /**
     * 処理に成功したらTemplateの作成処理も実行する
     *
     * @throws FileNotFoundException
     */
    public function handle(): bool
    {
        parent::handle();

        $this->call($this->name . '.blade', $this->arguments());
        $this->call($this->name . '.language', $this->arguments());
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
        $stub = $this->replaceResource($stub);
        return $this->replaceTemplate($stub);
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
    private function replaceResource(string $stub): string
    {
        $context = Str::snake($this->getContextInput());
        $entity = Str::snake(Str::plural($this->getEntityInput()));
        return str_replace(['{{ resource }}', '{{resource}}'], "{$context}.{$entity}", $stub);
    }

    /**
     * @param string $stub
     * @return string
     */
    private function replaceTemplate(string $stub): string
    {
        return str_replace(['{{ template }}', '{{template}}'], $this->getTemplateInput(), $stub);
    }
}
