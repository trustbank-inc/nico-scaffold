<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Store;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestInteractorInputCommand;

/**
 * 新規作成ユースケース入力のひな型のmakeコマンド
 */
final class MakeStoreInteractorInputCommand extends MakeRestInteractorInputCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-store-input';

    /**
     * @var string
     */
    protected $description = 'Create a new input for interactor (store)';

    /**
     * @var string
     */
    protected $type = 'Interactor(store) Input';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Store';
    }
}
