<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Controller\Index;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestRequestCommand;

/**
 * 一覧リクエストのひな型のmakeコマンド
 */
final class MakeRequestCommand extends MakeRestRequestCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Index';
    }
}
