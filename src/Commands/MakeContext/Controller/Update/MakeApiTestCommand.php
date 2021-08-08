<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Controller\Update;

use Seasalt\NicoScaffold\Components\MakeRestApiTestCommand;

/**
 * 更新APIテストのひな型のmakeコマンド
 */
final class MakeApiTestCommand extends MakeRestApiTestCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Update';
    }
}
