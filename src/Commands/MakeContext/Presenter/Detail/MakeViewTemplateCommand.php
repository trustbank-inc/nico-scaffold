<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Presenter\Detail;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestViewTemplateCommand;

/**
 * 詳細画面テンプレートのひな型のmakeコマンド
 */
final class MakeViewTemplateCommand extends MakeRestViewTemplateCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Detail';
    }
}
