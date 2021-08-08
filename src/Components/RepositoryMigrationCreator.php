<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Components;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Filesystem\Filesystem;

final class RepositoryMigrationCreator extends MigrationCreator
{
    use StubsFindable;

    /**
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct($files, $this->stubPath());
    }

    /**
     * @param string|null $table
     * @param bool $create
     * @return string
     * @throws FileNotFoundException
     */
    protected function getStub($table, $create): string
    {
        return $this->files->get($this->resolveStubPath('repository/repository.migration.stub'));
    }
}
