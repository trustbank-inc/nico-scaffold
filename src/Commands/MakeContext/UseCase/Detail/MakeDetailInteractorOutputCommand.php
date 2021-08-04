<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Detail;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestInteractorOutputCommand;

/**
 * 詳細取得ユースケース出力のひな型のmakeコマンド
 */
final class MakeDetailInteractorOutputCommand extends MakeRestInteractorOutputCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-detail-output';

    /**
     * @var string
     */
    protected $description = 'Create a new output for interactor (detail)';

    /**
     * @var string
     */
    protected $type = 'Interactor(detail) Output';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Detail';
    }
}
