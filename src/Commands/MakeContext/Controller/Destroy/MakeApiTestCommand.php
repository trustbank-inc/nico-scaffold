<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Controller\Destroy;

use Seasalt\NicoScaffold\Components\MakeRestApiTestCommand;

/**
 * 削除APIテストのひな型のmakeコマンド
 */
final class MakeApiTestCommand extends MakeRestApiTestCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Destroy';
    }
}
