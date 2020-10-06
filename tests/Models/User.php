<?php

namespace Vajexal\AttributeRelations\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\BelongsToMany;
use Vajexal\AttributeRelations\Relations\HasMany;
use Vajexal\AttributeRelations\Relations\HasOne;
use Vajexal\AttributeRelations\Relations\MorphOne;

#[HasOne(Phone::class)]
#[HasOne(Life::class)]
#[BelongsToMany(Role::class)]
#[HasMany(Post::class)]
#[MorphOne(Image::class, 'imageable')]
class User extends Model
{
}
