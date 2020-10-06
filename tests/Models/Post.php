<?php

namespace Vajexal\AttributeRelations\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\HasMany;
use Vajexal\AttributeRelations\Relations\MorphMany;
use Vajexal\AttributeRelations\Relations\MorphToMany;

#[HasMany(Comment::class)]
#[MorphMany(Image::class, 'imageable')]
#[MorphToMany(Tag::class, 'taggable')]
class Post extends Model
{
}
