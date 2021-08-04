<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase;

use Illuminate\Console\GeneratorCommand;
use Seasalt\NicoScaffold\Components\StubsFindable;
use Symfony\Component\Console\Input\InputArgument;

final class MakeInteractorInputCommand extends GeneratorCommand
{
    use StubsFindable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:interactor-input';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new input for interactor';

    /**
     * @var string
     */
    protected $type = 'Interactor input';

    /**
     * @return string
     */
    protected function getStub(): string
    {
        return $this->resolveStubPath('interactor.input.stub');
    }

    /**
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        $namespace = $rootNamespace . "\\Contexts\\{$this->getContextInput()}\\UseCase\\{$this->getUseCaseNameInput()}";
        if ($this->hasMethodInput()) {
            $namespace .= "\\{$this->getMethodInput()}";
        }
        return $namespace;
    }

    /**
     * @return array
     */
    protected function getArguments(): array
    {
        return [
            ['context', InputArgument::REQUIRED, 'The context for this UseCase'],
            ['use_case', InputArgument::REQUIRED, 'The name of this UseCase'],
            ['method', InputArgument::OPTIONAL, 'The method for this UseCase. if specified method, directory is "UseCase/{use_case}/{method}"'],
        ];
    }

    /**
     * @return string
     */
    protected function getNameInput(): string
    {
        return 'Input';
    }

    /**
     * @return string
     */
    protected function getUseCaseNameInput(): string
    {
        return trim($this->argument('use_case'));
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
     * Get the desired method from the input.
     *
     * @return bool
     */
    protected function hasMethodInput(): bool
    {
        return $this->argument('method') !== null;
    }

    /**
     * Get the desired method from the input.
     *
     * @return string
     */
    protected function getMethodInput(): string
    {
        return trim($this->argument('method'));
    }
}
