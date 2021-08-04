<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Controller\Index;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestRouteCommand;

/**
 * 一覧ルートのひな型のmakeコマンド
 */
final class MakeRouteCommand extends MakeRestRouteCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Index';
    }
}
