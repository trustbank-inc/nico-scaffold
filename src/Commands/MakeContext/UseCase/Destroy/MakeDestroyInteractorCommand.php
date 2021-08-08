<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Destroy;

use Seasalt\NicoScaffold\Components\MakeRestInteractorCommand;

/**
 * 削除ユースケースのひな型のmakeコマンド
 */
final class MakeDestroyInteractorCommand extends MakeRestInteractorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-destroy';

    /**
     * @var string
     */
    protected $description = 'Create a new interactor (destroy)';

    /**
     * @var string
     */
    protected $type = 'Interactor(destroy)';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Destroy';
    }
}
