<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Controller\Store;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestControllerCommand;

/**
 * 新規登録コントローラのひな型のmakeコマンド
 */
final class MakeControllerCommand extends MakeRestControllerCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Store';
    }
}
