<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Components;

trait StubsFindable
{
    private function resolveStubPath(string $path): string
    {
        $stub = base_path("stubs/{$path}");
        if (file_exists($stub)) {
            return $stub;
        }
        return dirname(__DIR__, 2) . '/stubs/' . $path;
    }
}
