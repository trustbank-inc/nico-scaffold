<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Destroy;

use Seasalt\NicoScaffold\Components\MakeRestInteractorOutputCommand;

/**
 * 削除ユースケース出力のひな型のmakeコマンド
 */
final class MakeDestroyInteractorOutputCommand extends MakeRestInteractorOutputCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-destroy-output';

    /**
     * @var string
     */
    protected $description = 'Create a new output for interactor (destroy)';

    /**
     * @var string
     */
    protected $type = 'Interactor(destroy) Output';

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
        // 今のところUpdateユースケースのOutputは不要
        return true;
    }
}
