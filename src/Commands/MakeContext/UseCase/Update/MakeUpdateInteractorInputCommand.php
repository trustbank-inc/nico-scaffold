<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Update;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestInteractorInputCommand;

/**
 * 更新ユースケース入力のひな型のmakeコマンド
 */
final class MakeUpdateInteractorInputCommand extends MakeRestInteractorInputCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-update-input';

    /**
     * @var string
     */
    protected $description = 'Create a new input for interactor (update)';

    /**
     * @var string
     */
    protected $type = 'Interactor(update) Input';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Update';
    }
}
