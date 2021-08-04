<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Seasalt\NicoScaffold\Components\StubsFindable;
use Symfony\Component\Console\Input\InputArgument;

/**
 * REST操作画面言語リソースのひな型のmakeコマンド
 *
 * @note 各ユースケースのmakeコマンドへ派生
 */
abstract class MakeRestViewLanguageCommand extends GeneratorCommand
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

        $this->name = "make:view-{$useCase}.language";
        $this->description = "Create a new view language ({$useCase})";
        $this->type = "ViewLanguage({$useCase})";

        parent::__construct($files);
    }

    /**
     * @return string
     */
    protected function getStub(): string
    {
        $useCase = Str::snake($this->getUseCase());
        return $this->resolveStubPath("presenter/{$useCase}/language.stub");
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
        return base_path("resources/lang/ja/{$context}/{$entity}/{$useCase}.php");
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
}
