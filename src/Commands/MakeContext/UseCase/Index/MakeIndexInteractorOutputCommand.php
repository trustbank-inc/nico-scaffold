<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Index;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestInteractorOutputCommand;

/**
 * 一覧取得ユースケース出力のひな型のmakeコマンド
 */
final class MakeIndexInteractorOutputCommand extends MakeRestInteractorOutputCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-index-output';

    /**
     * @var string
     */
    protected $description = 'Create a new output for interactor (index)';

    /**
     * @var string
     */
    protected $type = 'Interactor(index) Output';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Index';
    }
}
