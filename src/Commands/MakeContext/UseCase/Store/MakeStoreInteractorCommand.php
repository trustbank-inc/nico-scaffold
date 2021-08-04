<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Store;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestInteractorCommand;

/**
 * 新規作成ユースケースのひな型のmakeコマンド
 */
final class MakeStoreInteractorCommand extends MakeRestInteractorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-store';

    /**
     * @var string
     */
    protected $description = 'Create a new interactor (store)';

    /**
     * @var string
     */
    protected $type = 'Interactor(store)';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Store';
    }
}
