<?php

namespace Vajexal\AttributeRelations\Relations;

interface RelationAttribute
{
    public function guessRelationName(): string;
    public function getArguments(): array;
}
