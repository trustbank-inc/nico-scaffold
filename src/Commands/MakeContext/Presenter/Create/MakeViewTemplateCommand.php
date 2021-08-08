<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Presenter\Create;

use Seasalt\NicoScaffold\Components\MakeRestViewTemplateCommand;

/**
 * 新規作成画面テンプレートのひな型のmakeコマンド
 */
final class MakeViewTemplateCommand extends MakeRestViewTemplateCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Create';
    }
}
