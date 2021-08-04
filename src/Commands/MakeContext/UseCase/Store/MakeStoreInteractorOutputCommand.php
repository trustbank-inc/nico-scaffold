<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Store;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestInteractorOutputCommand;

/**
 * 新規作成ユースケース出力のひな型のmakeコマンド
 */
final class MakeStoreInteractorOutputCommand extends MakeRestInteractorOutputCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-store-output';

    /**
     * @var string
     */
    protected $description = 'Create a new output for interactor (store)';

    /**
     * @var string
     */
    protected $type = 'Interactor(store) Output';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Store';
    }
}
