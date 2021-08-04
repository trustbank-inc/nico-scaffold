<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Controller\Store;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestRequestCommand;

/**
 * 新規登録リクエストのひな型のmakeコマンド
 */
final class MakeRequestCommand extends MakeRestRequestCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Store';
    }
}
