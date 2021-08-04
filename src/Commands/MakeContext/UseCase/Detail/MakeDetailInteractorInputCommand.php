<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Detail;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestInteractorInputCommand;

/**
 * 詳細取得ユースケース入力のひな型のmakeコマンド
 */
final class MakeDetailInteractorInputCommand extends MakeRestInteractorInputCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-detail-input';

    /**
     * @var string
     */
    protected $description = 'Create a new input for interactor (detail)';

    /**
     * @var string
     */
    protected $type = 'Interactor(detail) Input';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Detail';
    }
}
