<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Controller\Create;

use Seasalt\NicoScaffold\Components\Infrastructure\MakeCommand\MakeRestRequestCommand;

/**
 * 新規作成リクエストのひな型のmakeコマンド
 */
final class MakeRequestCommand extends MakeRestRequestCommand
{
    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Create';
    }

    /**
     *
     */
    public function handle(): bool
    {
        // 今のところCreateコントローラのRequestは不要
        return true;
    }
}
