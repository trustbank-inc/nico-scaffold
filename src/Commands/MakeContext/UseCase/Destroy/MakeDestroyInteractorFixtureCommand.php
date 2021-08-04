<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Destroy;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestInteractorFixtureCommand;

/**
 * 削除ユースケーステストデータのひな型のmakeコマンド
 */
final class MakeDestroyInteractorFixtureCommand extends MakeRestInteractorFixtureCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-destroy-fixture';

    /**
     * @var string
     */
    protected $description = 'Create a new fixture for interactor (destroy)';

    /**
     * @var string
     */
    protected $type = 'Interactor(destroy) Fixture';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Destroy';
    }
}
