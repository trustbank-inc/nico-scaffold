<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Controller\Store;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestApiTestCommand;

/**
 * 新規登録APIテストのひな型のmakeコマンド
 */
final class MakeApiTestCommand extends MakeRestApiTestCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Store';
    }
}
