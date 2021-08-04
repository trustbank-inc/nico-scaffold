<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Update;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestInteractorTestCommand;

/**
 * 更新ユースケーステストのひな型のmakeコマンド
 */
final class MakeUpdateInteractorTestCommand extends MakeRestInteractorTestCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-update-test';

    /**
     * @var string
     */
    protected $description = 'Create a new testcase for interactor (update)';

    /**
     * @var string
     */
    protected $type = 'Interactor(update) Test';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Update';
    }
}
