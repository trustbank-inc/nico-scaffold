<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Detail;

use Seasalt\NicoScaffold\Components\MakeRestInteractorCommand;

/**
 * 詳細取得ユースケースのひな型のmakeコマンド
 */
final class MakeDetailInteractorCommand extends MakeRestInteractorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-detail';

    /**
     * @var string
     */
    protected $description = 'Create a new interactor (detail)';

    /**
     * @var string
     */
    protected $type = 'Interactor(detail)';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Detail';
    }
}
