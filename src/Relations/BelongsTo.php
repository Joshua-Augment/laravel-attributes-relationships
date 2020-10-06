<?php

namespace Vajexal\AttributeRelations\Relations;

use Attribute;
use Illuminate\Support\Str;

#[Attribute(Attribute::TARGET_CLASS|Attribute::IS_REPEATABLE)]
class BelongsTo implements RelationAttribute
{
    private string $related;
    private array  $arguments;

    public function __construct(string $related, array ...$arguments)
    {
        $this->related   = $related;
        $this->arguments = [$related, ...$arguments];

        // We should explicitly set relation because otherwise laravel will try to guess by debug backtrace
        $this->arguments = array_pad($this->arguments, 4, null);
        if ($this->arguments[3] === null) {
            $this->arguments[3] = $this->guessRelationName();
        }
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
