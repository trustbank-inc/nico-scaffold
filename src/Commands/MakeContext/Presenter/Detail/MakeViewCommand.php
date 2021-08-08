<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Presenter\Detail;

use Seasalt\NicoScaffold\Components\MakeRestViewCommand;

/**
 * 詳細画面のひな型のmakeコマンド
 */
final class MakeViewCommand extends MakeRestViewCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Detail';
    }
}
