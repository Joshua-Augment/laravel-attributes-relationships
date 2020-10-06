<?php

namespace Vajexal\AttributeRelations\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\HasMany;
use Vajexal\AttributeRelations\Relations\HasManyThrough;

#[HasManyThrough(Post::class, User::class)]
#[HasMany(User::class)]
class Country extends Model
{
}
