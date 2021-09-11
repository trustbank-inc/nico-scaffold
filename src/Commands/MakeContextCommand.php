<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

final class MakeContextCommand extends Command
{
    /**
     * action: "index", "detail", "create", "store", "update", "destroy" or "none"
     *
     * @var string
     */
    protected $signature = 'make:context {name} {entity} {model?}
        {--action= : Select "index", "detail", "create", "store", "update", "destroy" or "none"} {--api}';

    /**
     * @var string
     */
    protected $description = 'Create a new context';

    /**
     * @return int
     */
    public function handle(): int
    {
        $action = $this->option('action');
        $validator = Validator::make(['action' => $action], 
            ['action' => ['regex:/^(index)|(detail)|(create)|(store)|(update)|(destroy)|(none)$/', 'nullable'],
        ]);
        try {
            $validator->validate();
        } catch (ValidationException) {
            $this->error('--action= : "index", "detail", "create", "store", "update", "destroy" or "none" is acceptable.');
            return 1;
        }
        $validator->validate();
        switch ($action) {
            case 'none':
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
                $this->makeAllComponents();
        }

        $this->line('<info>Context classes created successfully.</info>');
        return 0;
    }

    private function makeAllComponents(): void
    {
        $this->makeCommonComponents();
        $this->makeIndexComponents();
        $this->makeDetailComponents();
        $this->makeCreateComponents();
        $this->makeStoreComponents();
        $this->makeUpdateComponents();
        $this->makeDestroyComponents();
    }

    private function makeCommonComponents(): void
    {
        list($context, $entity, $model) = [$this->getContextInput(), $this->getEntityInput(), $this->getModelInput()];

        $this->call('make:entity', compact('context', 'entity'));
        $this->call('make:repository-exception', compact('context', 'entity'));
        $this->call('make:repository-model', compact('context', 'model'));
        $this->call('make:repository-model-factory', compact('model'));
        if ($this->option('api')) {
            $this->call('make:api-token-migration');
        }
    }

    private function makeIndexComponents(): void
    {
        list($context, $entity, $model) = [$this->getContextInput(), $this->getEntityInput(), $this->getModelInput()];

        $this->call('make:interactor-index', compact('context', 'entity'));
        $this->call('make:interactor-index-test', compact('context', 'entity', 'model'));
        if ($this->option('api')) {
            $this->call('make:controller-index', $this->getApiParam());
            $this->call('make:api-test-index', $this->getApiTestParam());
        } else {
            $this->call('make:controller-index', compact('context', 'entity'));
            $this->call('make:view-index', compact('context', 'entity'));
        }
    }

    private function makeDetailComponents(): void
    {
        list($context, $entity, $model) = [$this->getContextInput(), $this->getEntityInput(), $this->getModelInput()];

        $this->call('make:interactor-detail', compact('context', 'entity'));
        $this->call('make:interactor-detail-test', compact('context', 'entity', 'model'));
        if ($this->option('api')) {
            $this->call('make:controller-detail', $this->getApiParam());
            $this->call('make:api-test-detail', $this->getApiTestParam());
        } else {
            $this->call('make:controller-detail', compact('context', 'entity'));
            $this->call('make:view-detail', compact('context', 'entity'));
        }
    }

    private function makeCreateComponents(): void
    {
        list($context, $entity, $model) = [$this->getContextInput(), $this->getEntityInput(), $this->getModelInput()];

        if ($this->option('api')) {

        } else {
            $this->call('make:controller-create', compact('context', 'entity'));
            $this->call('make:view-create', compact('context', 'entity'));
        }
    }

    private function makeStoreComponents(): void
    {
        list($context, $entity, $model) = [$this->getContextInput(), $this->getEntityInput(), $this->getModelInput()];

        $this->call('make:interactor-store', compact('context', 'entity'));
        $this->call('make:interactor-store-test', compact('context', 'entity', 'model'));
        if ($this->option('api')) {
            $this->call('make:controller-store', $this->getApiParam());
            $this->call('make:api-test-store', $this->getApiTestParam());
        } else {
            $this->call('make:controller-store', compact('context', 'entity'));
        }

    }

    private function makeUpdateComponents(): void
    {
        list($context, $entity, $model) = [$this->getContextInput(), $this->getEntityInput(), $this->getModelInput()];

        $this->call('make:interactor-update', compact('context', 'entity'));
        $this->call('make:interactor-update-test', compact('context', 'entity', 'model'));
        if ($this->option('api')) {
            $this->call('make:controller-update', $this->getApiParam());
            $this->call('make:api-test-update', $this->getApiTestParam());
        } else {
            $this->call('make:controller-update', compact('context', 'entity'));
        }
    }

    private function makeDestroyComponents(): void
    {
        list($context, $entity, $model) = [$this->getContextInput(), $this->getEntityInput(), $this->getModelInput()];

        $this->call('make:interactor-destroy', compact('context', 'entity'));
        $this->call('make:interactor-destroy-test', compact('context', 'entity', 'model'));
        if ($this->option('api')) {
            $this->call('make:controller-destroy', $this->getApiParam());
            $this->call('make:api-test-destroy', $this->getApiTestParam());
        } else {
            $this->call('make:controller-destroy', compact('context', 'entity'));
        }
    }

    private function getContextInput(): string
    {
        return $this->argument('name');
    }

    private function getEntityInput(): string
    {
        return $this->argument('entity');
    }

    private function getModelInput(): string
    {
        return $this->argument('model') ?? $this->argument('entity');
    }

    private function getApiParam(): array
    {
        return [
            'context' => $this->getContextInput(),
            'entity' => $this->getEntityInput(),
            '--api' => true,
        ];
    }

    private function getApiTestParam(): array
    {
        return [
            'context' => $this->getContextInput(),
            'entity' => $this->getEntityInput(),
            'model' => $this->getModelInput(),
        ];
    }
}
