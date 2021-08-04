<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Controller\Destroy;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestRequestCommand;

/**
 * 削除リクエストのひな型のmakeコマンド
 */
final class MakeRequestCommand extends MakeRestRequestCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Destroy';
    }

    /**
     *
     */
    public function handle(): bool
    {
        // 今のところDestroyコントローラのRequestは不要
        return true;
    }
}
