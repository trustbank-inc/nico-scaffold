<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands\MakeContext\Repository;

use Illuminate\Console\Command;

final class RegisterRepositoryCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'repository:register {context} {interface} {implements?}';

    /**
     * @var string
     */
    protected $description = 'Register repository interface and implements';

    /**
     * @return int
     */
    public function handle(): int
    {
        $manifestPath = base_path('bootstrap/cache/contexts.php');
        $services = [];
        if (file_exists($manifestPath)) {
            $services = require($manifestPath);
        }
        $context = $this->argument('context');
        if (!isset($services[$context])) {
            $services[$context] = [];
        }
        $interface = $this->argument('interface');
        $implements = $this->argument('implements') ??
            str_replace(search: '\\Domain\\', replace: '\\Infrastructure\\', subject: $interface) . 'Impl';
        if (!isset($services[$context][$interface])) {
            $services[$context][$interface] = $implements;
            file_put_contents($manifestPath, '<?php return ' . var_export($services, true) . ';');
        }

        $this->line("<info>Registered Interface:</info> {$interface}");
        return 0;
    }
}
