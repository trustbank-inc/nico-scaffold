<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Components;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

/**
 * REST操作画面テンプレートのひな型のmakeコマンド
 *
 * @note 各ユースケースのmakeコマンドへ派生
 */
abstract class MakeRestViewTemplateCommand extends GeneratorCommand
{
    use StubsFindable;

    /**
     * @var string
     */
    protected $name = 'make:view-create.blade';

    /**
     * @var string
     */
    protected $description = 'Create a new view template (create)';

    /**
     * @var string
     */
    protected $type = 'ViewTemplate(create)';

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

        $this->name = "make:view-{$useCase}.blade";
        $this->description = "Create a new view template ({$useCase})";
        $this->type = "ViewTemplate({$useCase})";

        parent::__construct($files);
    }

    /**
     * @return string
     */
    protected function getStub(): string
    {
        $useCase = Str::snake($this->getUseCase());
        return $this->resolveStubPath("presenter/{$useCase}/blade.stub");
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
        return base_path("resources/views/{$context}/{$entity}/{$useCase}.blade.php");
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
        $useCase = Str::snake($this->getUseCase());
        return "{$useCase}.php";
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
        return $this->replaceLanguage($stub);
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
    private function replaceUri(string $stub): string
    {
        return str_replace(['{{ uri }}', '{{uri}}'], $this->getUriInput(), $stub);
    }

    /**
     * @param string $stub
     * @return string
     */
    private function replaceLanguage(string $stub): string
    {
        $context = Str::snake($this->getContextInput());
        $entity = Str::snake($this->getEntityInput());
        return str_replace(['{{ lang }}', '{{lang}}'], "{$context}/{$entity}", $stub);
    }
}
