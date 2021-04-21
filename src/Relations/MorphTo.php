<?php

namespace Vajexal\AttributeRelations\Relations;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class MorphTo implements RelationAttribute
{
    private string $name;
    private array  $arguments;

    /**
     * @no-named-arguments
     */
    public function __construct(string $name, array ...$arguments)
    {
        $this->name      = $name;
        $this->arguments = [$name, ...$arguments];
    }

    public function guessRelationName(): string
    {
        return $this->name;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }
}
