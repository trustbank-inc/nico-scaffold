<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Presenter\Index;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestViewCommand;

/**
 * 一覧画面のひな型のmakeコマンド
 */
final class MakeViewCommand extends MakeRestViewCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Index';
    }
}
