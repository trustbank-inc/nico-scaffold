<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Presenter\Detail;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestViewLanguageCommand;

/**
 * 詳細画面言語リソースのひな型のmakeコマンド
 */
final class MakeViewLanguageCommand extends MakeRestViewLanguageCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Detail';
    }
}
