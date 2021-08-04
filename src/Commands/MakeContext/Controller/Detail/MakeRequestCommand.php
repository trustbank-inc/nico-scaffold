<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Controller\Detail;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestRequestCommand;

/**
 * 詳細取得リクエストのひな型のmakeコマンド
 */
final class MakeRequestCommand extends MakeRestRequestCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Detail';
    }

    /**
     *
     */
    public function handle(): bool
    {
        // 今のところDetailコントローラのRequestは不要
        return true;
    }
}
