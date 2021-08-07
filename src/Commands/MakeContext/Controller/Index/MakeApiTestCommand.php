<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Controller\Index;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestApiTestCommand;

/**
 * 一覧APIテストのひな型のmakeコマンド
 */
final class MakeApiTestCommand extends MakeRestApiTestCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Index';
    }
}
