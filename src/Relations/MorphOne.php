<?php

namespace Vajexal\AttributeRelations\Relations;

use Attribute;
use Illuminate\Support\Str;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class MorphOne implements RelationAttribute
{
    private string $related;
    private string $name;
    private array  $arguments;

    /**
     * @no-named-arguments
     */
    public function __construct(string $related, string $name, array ...$arguments)
    {
        $this->related   = $related;
        $this->name      = $name;
        $this->arguments = [$related, $name, ...$arguments];
    }

    public function guessRelationName(): string
    {
        return Str::singular(mb_strtolower(class_basename($this->related)));
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }
}
