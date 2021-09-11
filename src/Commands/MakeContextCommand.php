<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands;

use Illuminate\Console\Command;

final class MakeContextCommand extends Command
{
    /**
     * action: index, detail, create, store, update, destroy, common and all
     *      common: entity and repository only
     *      all   : all components
     * 
     * @var string
     */
    protected $signature = 'make:context {name} {entity} {model?}
        {--action= : index, detail, create, store, update, destroy, common and all (default: all)} {--api}';

    /**
     * @var string
     */
    protected $description = 'Create a new context';

    /**@var stirng */
    private $context;

    /**@var stirng */
    private $entity;

    /**@var stirng */
    private $model;

    /** @var array */
    private $apiParam;

    /** @var array */
    private $apiTestParam;

    /**
     * @return int
     */
    public function handle(): int
    {
        $this->context = $this->argument('name');
        $this->entity = $this->argument('entity');
        $this->model = $this->argument('model') ?? $this->argument('entity');
        $action = $this->option('action') ?? 'all';

        if ($this->option('api')) {
            $this->apiParam = [
				'context' => $this->context,
				'entity' => $this->entity,
				'--api' => true,
			];
            $this->apiTestParam = [
				'context' => $this->context,
				'entity' => $this->entity,
				'model' => $this->model,
			];
        }

        switch ($action) {
            case 'all':
                $this->makeAllComponents();
                break;
            case 'common':
                $this->makeCommonComponents();
                break;
            case 'index':
                $this->makeCommonComponents();
                $this->makeIndexComponents();
                break;
            case 'detail':
                $this->makeCommonComponents();
                $this->makeDetailComponents();
                break;
            case 'create':
                $this->makeCommonComponents();
                $this->makeCreateComponents();
                break;
            case 'store':
                $this->makeCommonComponents();
                $this->makeStoreComponents();
                break;
            case 'update':
                $this->makeCommonComponents();
                $this->makeUpdateComponents();
                break;
            case 'destroy':
                $this->makeCommonComponents();
                $this->makeDestroyComponents();
                break;
            default:
                $this->error('Context classes\'s creation faild.');
                return 1;
        }
        $this->line('<info>Context classes created successfully.</info>');
        return 0;  
    }

    public function makeAllComponents(): void
    {
        $this->makeCommonComponents();
        $this->makeIndexComponents();
        $this->makeDetailComponents();
        $this->makeCreateComponents();
        $this->makeStoreComponents();
        $this->makeUpdateComponents();
        $this->makeDestroyComponents();
    }

    public function makeCommonComponents(): void
    {
        list($context, $entity, $model) = [$this->context, $this->entity, $this->model];

        $this->call('make:entity', compact('context', 'entity'));
        $this->call('make:repository-exception', compact('context', 'entity'));
        $this->call('make:repository-model', compact('context', 'model'));
        $this->call('make:repository-model-factory', compact('model'));
        if ($this->option('api')) {
            $this->call('make:api-token-migration');
        }
    }

    public function makeIndexComponents(): void
    {
        list($context, $entity, $model) = [$this->context, $this->entity, $this->model];

        $this->call('make:interactor-index', compact('context', 'entity'));
        $this->call('make:interactor-index-test', compact('context', 'entity', 'model'));
        if ($this->option('api')) {
		    $this->call('make:controller-index', $this->apiParam);
		    $this->call('make:api-test-index', $this->apiTestParam);
        } else {
            $this->call('make:controller-index', compact('context', 'entity'));
            $this->call('make:view-index', compact('context', 'entity'));
        }
    }

    public function makeDetailComponents(): void
    {
        list($context, $entity, $model) = [$this->context, $this->entity, $this->model];

        $this->call('make:interactor-detail', compact('context', 'entity'));
        $this->call('make:interactor-detail-test', compact('context', 'entity', 'model'));
        if ($this->option('api')) {
            $this->call('make:controller-detail', $this->apiParam);
            $this->call('make:api-test-detail', $this->apiTestParam);
        } else {
            $this->call('make:controller-detail', compact('context', 'entity'));
            $this->call('make:view-detail', compact('context', 'entity'));
        }
    }

    public function makeCreateComponents(): void
    {
        list($context, $entity, $model) = [$this->context, $this->entity, $this->model];

        if ($this->option('api')) {

        } else {
		    $this->call('make:controller-create', compact('context', 'entity'));
		    $this->call('make:view-create', compact('context', 'entity'));
        }
    }

    public function makeStoreComponents(): void
    {
        list($context, $entity, $model) = [$this->context, $this->entity, $this->model];

        $this->call('make:interactor-store', compact('context', 'entity'));
        $this->call('make:interactor-store-test', compact('context', 'entity', 'model'));
        if ($this->option('api')) {
            $this->call('make:controller-store', $this->apiParam);
            $this->call('make:api-test-store', $this->apiTestParam);
        } else {
            $this->call('make:controller-store', compact('context', 'entity'));
        }

    }

    public function makeUpdateComponents(): void
    {
        list($context, $entity, $model) = [$this->context, $this->entity, $this->model];

        $this->call('make:interactor-update', compact('context', 'entity'));
        $this->call('make:interactor-update-test', compact('context', 'entity', 'model'));
        if ($this->option('api')) {
            $this->call('make:controller-update', $this->apiParam);
            $this->call('make:api-test-update', $this->apiTestParam);
        } else {
		    $this->call('make:controller-update', compact('context', 'entity'));
        }
    }

    public function makeDestroyComponents(): void
    {
        list($context, $entity, $model) = [$this->context, $this->entity, $this->model];

        $this->call('make:interactor-destroy', compact('context', 'entity'));
        $this->call('make:interactor-destroy-test', compact('context', 'entity', 'model'));
        if ($this->option('api')) {
            $this->call('make:controller-destroy', $this->apiParam);
            $this->call('make:api-test-destroy', $this->apiTestParam);
        } else {
            $this->call('make:controller-destroy', compact('context', 'entity'));
        }
    }
}
