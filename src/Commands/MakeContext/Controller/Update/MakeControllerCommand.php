<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Controller\Update;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestControllerCommand;

/**
 * 更新コントローラのひな型のmakeコマンド
 */
final class MakeControllerCommand extends MakeRestControllerCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Update';
    }
}
