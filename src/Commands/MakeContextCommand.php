<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands;

use Illuminate\Console\Command;

final class MakeContextCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'make:context {name} {entity} {model?} {--api}';

    /**
     * @var string
     */
    protected $description = 'Create a new context';

    /**
     * @return int
     */
    public function handle(): int
    {
        $context = $this->argument('name');
        $entity = $this->argument('entity');
        $model = $this->argument('model') ?? $this->argument('entity');

        $this->call('make:entity', compact('context', 'entity'));
        $this->call('make:repository-exception', compact('context', 'entity'));
        $this->call('make:repository-model', compact('model'));
        $this->call('make:interactor-store', compact('context', 'entity'));
        $this->call('make:interactor-index', compact('context', 'entity'));
        $this->call('make:interactor-detail', compact('context', 'entity'));
        $this->call('make:interactor-update', compact('context', 'entity'));
        $this->call('make:interactor-destroy', compact('context', 'entity'));
        $this->call('make:interactor-store-test', compact('context', 'entity', 'model'));
        $this->call('make:interactor-index-test', compact('context', 'entity', 'model'));
        $this->call('make:interactor-detail-test', compact('context', 'entity', 'model'));
        $this->call('make:interactor-update-test', compact('context', 'entity', 'model'));
        $this->call('make:interactor-destroy-test', compact('context', 'entity', 'model'));
        if ($this->option('api')) {
        	$apiParam = [
				'context' => $context,
				'entity' => $entity,
				'--api' => true,
			];
			$this->call('make:controller-index', $apiParam);
			$this->call('make:controller-detail', $apiParam);
			$this->call('make:controller-store', $apiParam);
			$this->call('make:controller-update', $apiParam);
			$this->call('make:controller-destroy', $apiParam);
			$apiTestParam = [
				'context' => $context,
				'entity' => $entity,
				'model' => $model,
			];
			$this->call('make:api-test-index', $apiTestParam);
			$this->call('make:api-test-detail', $apiTestParam);
			$this->call('make:api-test-store', $apiTestParam);
			$this->call('make:api-test-update', $apiTestParam);
			$this->call('make:api-test-destroy', $apiTestParam);
		} else {
			$this->call('make:controller-index', compact('context', 'entity'));
			$this->call('make:controller-create', compact('context', 'entity'));
			$this->call('make:controller-store', compact('context', 'entity'));
			$this->call('make:controller-detail', compact('context', 'entity'));
			$this->call('make:controller-update', compact('context', 'entity'));
			$this->call('make:controller-destroy', compact('context', 'entity'));
			$this->call('make:view-index', compact('context', 'entity'));
			$this->call('make:view-create', compact('context', 'entity'));
			$this->call('make:view-detail', compact('context', 'entity'));
		}

        $this->line('<info>Context classes created successfully.</info>');
        return 0;
    }
}
