<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\UseCase\Update;

use Seasalt\NicoScaffold\Components\MakeRestInteractorOutputCommand;

/**
 * 更新ユースケース出力のひな型のmakeコマンド
 */
final class MakeUpdateInteractorOutputCommand extends MakeRestInteractorOutputCommand
{
    /**
     * @var string
     */
    protected $name = 'make:interactor-update-output';

    /**
     * @var string
     */
    protected $description = 'Create a new output for interactor (update)';

    /**
     * @var string
     */
    protected $type = 'Interactor(update) Output';

    /**
     * @return string
     */
    protected function getUseCase(): string
    {
        return 'Update';
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
