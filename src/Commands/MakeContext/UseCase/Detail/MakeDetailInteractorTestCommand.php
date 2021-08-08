<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Detail;

use Seasalt\NicoScaffold\Components\MakeRestInteractorTestCommand;

/**
 * 詳細取得ユースケーステストのひな型のmakeコマンド
 */
final class MakeDetailInteractorTestCommand extends MakeRestInteractorTestCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-detail-test';

    /**
     * @var string
     */
    protected $description = 'Create a new testcase for interactor (detail)';

    /**
     * @var string
     */
    protected $type = 'Interactor(detail) Test';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Detail';
    }
}
