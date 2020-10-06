<?php

namespace Vajexal\AttributeRelations\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\BelongsToMany;

#[BelongsToMany(User::class)]
class Role extends Model
{
}
