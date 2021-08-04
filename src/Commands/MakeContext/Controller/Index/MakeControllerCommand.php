<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Controller\Index;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestControllerCommand;

/**
 * 一覧コントローラのひな型のmakeコマンド
 */
final class MakeControllerCommand extends MakeRestControllerCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Index';
    }
}
