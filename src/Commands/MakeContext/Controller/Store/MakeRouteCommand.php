<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Controller\Store;

use Seasalt\NicoScaffold\Components\MakeRestRouteCommand;

/**
 * 新規登録ルートのひな型のmakeコマンド
 */
final class MakeRouteCommand extends MakeRestRouteCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Store';
    }
}
