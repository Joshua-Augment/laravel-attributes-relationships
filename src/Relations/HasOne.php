<?php

namespace Vajexal\AttributeRelations\Relations;

use Attribute;
use Illuminate\Support\Str;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class HasOne implements RelationAttribute
{
    private string $related;
    private array  $arguments;

    /**
     * @no-named-arguments
     */
    public function __construct(string $related, array ...$arguments)
    {
        $this->related   = $related;
        $this->arguments = [$related, ...$arguments];
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
