<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Controller\Detail;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestControllerCommand;

/**
 * 詳細取得コントローラのひな型のmakeコマンド
 */
final class MakeControllerCommand extends MakeRestControllerCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Detail';
    }
}
