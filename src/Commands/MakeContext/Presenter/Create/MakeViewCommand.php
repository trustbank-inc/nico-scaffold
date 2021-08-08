<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Presenter\Create;

use Seasalt\NicoScaffold\Components\MakeRestViewCommand;

/**
 * 新規作成画面のひな型のmakeコマンド
 */
final class MakeViewCommand extends MakeRestViewCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Create';
    }
}
