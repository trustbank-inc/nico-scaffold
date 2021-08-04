<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Controller\Destroy;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestRouteCommand;

/**
 * 削除ルートのひな型のmakeコマンド
 */
final class MakeRouteCommand extends MakeRestRouteCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Destroy';
    }
}
