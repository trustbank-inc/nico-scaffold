<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Update;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestInteractorCommand;

/**
 * 更新ユースケースのひな型のmakeコマンド
 */
final class MakeUpdateInteractorCommand extends MakeRestInteractorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-update';

    /**
     * @var string
     */
    protected $description = 'Create a new interactor (update)';

    /**
     * @var string
     */
    protected $type = 'Interactor(update)';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Update';
    }
}
