<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Presenter\Index;

use Seasalt\NicoScaffold\Components\MakeRestViewLanguageCommand;

/**
 * 一覧画面言語リソースのひな型のmakeコマンド
 */
final class MakeViewLanguageCommand extends MakeRestViewLanguageCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Index';
    }
}
