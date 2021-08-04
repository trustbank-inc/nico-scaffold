<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Presenter\Create;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestViewLanguageCommand;

/**
 * 新規作成画面言語リソースのひな型のmakeコマンド
 */
final class MakeViewLanguageCommand extends MakeRestViewLanguageCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Create';
    }
}
