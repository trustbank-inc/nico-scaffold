<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Index;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestInteractorCommand;

/**
 * 一覧ユースケースのひな型のmakeコマンド
 */
final class MakeIndexInteractorCommand extends MakeRestInteractorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-index';

    /**
     * @var string
     */
    protected $description = 'Create a new interactor (index)';

    /**
     * @var string
     */
    protected $type = 'Interactor(index)';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Index';
    }
}
