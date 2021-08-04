<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Components\Domain\Entity;

/**
 * ID生成
 */
interface IdGenerator
{
    public function generate(): string;
}
