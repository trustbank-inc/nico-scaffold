<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Controller\Detail;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestApiTestCommand;

/**
 * 詳細取得APIテストのひな型のmakeコマンド
 */
final class MakeApiTestCommand extends MakeRestApiTestCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Detail';
    }
}
