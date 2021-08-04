<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Index;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestInteractorTestCommand;

/**
 * 一覧取得ユースケーステストのひな型のmakeコマンド
 */
final class MakeIndexInteractorTestCommand extends MakeRestInteractorTestCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-index-test';

    /**
     * @var string
     */
    protected $description = 'Create a new testcase for interactor (index)';

    /**
     * @var string
     */
    protected $type = 'Interactor(index) Test';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Index';
    }
}
