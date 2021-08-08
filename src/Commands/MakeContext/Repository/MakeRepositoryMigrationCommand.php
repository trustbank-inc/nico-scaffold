<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Repository;

use Seasalt\NicoScaffold\Components\RepositoryMigrationCreator;
use Illuminate\Database\Console\Migrations\MigrateMakeCommand;
use Illuminate\Support\Composer;

final class MakeRepositoryMigrationCommand extends MigrateMakeCommand
{
    /**
     * @var string
     */
    protected $signature = 'make:repository-migration {name : The name of the migration}
        {--create= : The table to be created}
        {--table= : The table to migrate}
        {--path= : The location where the migration file should be created}
        {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
        {--fullpath : Output the full path of the migration}';

    public function __construct(RepositoryMigrationCreator $creator, Composer $composer)
    {
        parent::__construct($creator, $composer);
    }
}
