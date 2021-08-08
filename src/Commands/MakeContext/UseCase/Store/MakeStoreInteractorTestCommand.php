<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Store;

use Seasalt\NicoScaffold\Components\MakeRestInteractorTestCommand;

/**
 * 新規作成ユースケーステストのひな型のmakeコマンド
 */
final class MakeStoreInteractorTestCommand extends MakeRestInteractorTestCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-store-test';

    /**
     * @var string
     */
    protected $description = 'Create a new testcase for interactor (store)';

    /**
     * @var string
     */
    protected $type = 'Interactor(store) Test';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Store';
    }
}
