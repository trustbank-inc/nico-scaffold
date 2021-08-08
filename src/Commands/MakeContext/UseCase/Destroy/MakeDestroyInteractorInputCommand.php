<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Destroy;

use Seasalt\NicoScaffold\Components\MakeRestInteractorInputCommand;

/**
 * 削除ユースケース入力のひな型のmakeコマンド
 */
final class MakeDestroyInteractorInputCommand extends MakeRestInteractorInputCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-destroy-input';

    /**
     * @var string
     */
    protected $description = 'Create a new input for interactor (destroy)';

    /**
     * @var string
     */
    protected $type = 'Interactor(destroy) Input';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Destroy';
    }
}
