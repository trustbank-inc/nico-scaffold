<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Presenter\Index;

use Seasalt\NicoScaffold\Components\MakeRestViewTemplateCommand;

/**
 * 一覧画面テンプレートのひな型のmakeコマンド
 */
final class MakeViewTemplateCommand extends MakeRestViewTemplateCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Index';
    }
}
