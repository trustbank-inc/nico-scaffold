<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Store;

use Seasalt\NicoScaffold\Components\MakeRestInteractorFixtureCommand;

/**
 * 新規作成ユースケーステストデータのひな型のmakeコマンド
 */
final class MakeStoreInteractorFixtureCommand extends MakeRestInteractorFixtureCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-store-fixture';

    /**
     * @var string
     */
    protected $description = 'Create a new fixture for interactor (store)';

    /**
     * @var string
     */
    protected $type = 'Interactor(store) Fixture';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Store';
    }

    /**
     *
     */
    public function handle(): bool
    {
        // 今のところStoreユースケースのFixtureは不要
        return true;
    }
}
