<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Destroy;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestInteractorTestCommand;

/**
 * 削除ユースケーステストのひな型のmakeコマンド
 */
final class MakeDestroyInteractorTestCommand extends MakeRestInteractorTestCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-destroy-test';

    /**
     * @var string
     */
    protected $description = 'Create a new testcase for interactor (destroy)';

    /**
     * @var string
     */
    protected $type = 'Interactor(destroy) Test';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Destroy';
    }
}
