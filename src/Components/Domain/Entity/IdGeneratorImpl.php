<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Components\Domain\Entity;

use Ulid\Ulid;

/**
 * 生成順序が保持されるUUID
 */
final class IdGeneratorImpl implements IdGenerator
{
    public function generate(): string
    {
        return (string)Ulid::generate();
    }
}
