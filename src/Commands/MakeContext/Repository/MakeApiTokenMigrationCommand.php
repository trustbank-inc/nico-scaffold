<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Repository;

use Illuminate\Console\GeneratorCommand;
use Seasalt\NicoScaffold\Components\StubsFindable;

/**
 * APIトークン認証用のマイグレーションのmakeコマンド
 */
final class MakeApiTokenMigrationCommand extends GeneratorCommand
{
    use StubsFindable;

    /**
     * @var string
     */
    protected $name = 'make:api-token-migration';

    /**
     * @var string
     */
    protected $description = 'Create a new api token migration';

    /**
     * @var string
     */
    protected $type = 'Api token migration';

    /**
     * @return string
     */
    protected function getStub(): string
    {
        return $this->resolveStubPath('controller/api_token.migration.stub');
    }

    /**
     * @param string $name
     * @return string
     */
    protected function getPath($name): string
    {
        return base_path("database/migrations/contexts/{$this->getNameInput()}");
    }

    /**
     * @return array
     */
    protected function getArguments(): array
    {
        return [

        ];
    }

    /**
     * @return string
     */
    protected function getNameInput(): string
    {
        return "users_api_token_column.php";
    }
}
