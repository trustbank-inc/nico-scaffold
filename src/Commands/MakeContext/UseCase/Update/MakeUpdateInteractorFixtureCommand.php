<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Update;

use Seasalt\NicoScaffold\Components\MakeRestInteractorFixtureCommand;

/**
 * 更新ユースケーステストデータのひな型のmakeコマンド
 */
final class MakeUpdateInteractorFixtureCommand extends MakeRestInteractorFixtureCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-update-fixture';

    /**
     * @var string
     */
    protected $description = 'Create a new fixture for interactor (update)';

    /**
     * @var string
     */
    protected $type = 'Interactor(update) Fixture';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Update';
    }
}
