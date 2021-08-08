<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Controller\Detail;

use Seasalt\NicoScaffold\Components\MakeRestRouteCommand;

/**
 * 詳細取得ルートのひな型のmakeコマンド
 */
final class MakeRouteCommand extends MakeRestRouteCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Detail';
    }
}
