<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Controller\Create;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestControllerCommand;

/**
 * 新規作成コントローラのひな型のmakeコマンド
 */
final class MakeControllerCommand extends MakeRestControllerCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Create';
    }
}
