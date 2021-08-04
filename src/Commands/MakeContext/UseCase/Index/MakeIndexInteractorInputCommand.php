<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Index;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestInteractorInputCommand;

/**
 * 一覧取得ユースケース入力のひな型のmakeコマンド
 */
final class MakeIndexInteractorInputCommand extends MakeRestInteractorInputCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-index-input';

    /**
     * @var string
     */
    protected $description = 'Create a new input for interactor (index)';

    /**
     * @var string
     */
    protected $type = 'Interactor(index) Input';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Index';
    }
}
