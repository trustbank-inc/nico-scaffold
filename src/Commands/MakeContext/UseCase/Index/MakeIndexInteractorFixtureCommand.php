<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Index;

use Seasalt\NicoScaffold\Components\MakeRestInteractorFixtureCommand;

/**
 * 一覧取得ユースケーステストデータのひな型のmakeコマンド
 */
final class MakeIndexInteractorFixtureCommand extends MakeRestInteractorFixtureCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-index-fixture';

    /**
     * @var string
     */
    protected $description = 'Create a new fixture for interactor (index)';

    /**
     * @var string
     */
    protected $type = 'Interactor(index) Fixture';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Index';
    }
}
