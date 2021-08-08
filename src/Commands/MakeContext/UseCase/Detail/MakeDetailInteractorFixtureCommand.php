<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Detail;

use Seasalt\NicoScaffold\Components\MakeRestInteractorFixtureCommand;

/**
 * 詳細取得ユースケーステストデータのひな型のmakeコマンド
 */
final class MakeDetailInteractorFixtureCommand extends MakeRestInteractorFixtureCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-detail-fixture';

    /**
     * @var string
     */
    protected $description = 'Create a new fixture for interactor (detail)';

    /**
     * @var string
     */
    protected $type = 'Interactor(detail) Fixture';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Detail';
    }
}
