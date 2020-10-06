<?php

namespace Vajexal\AttributeRelations\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\MorphedByMany;

#[MorphedByMany(Post::class, 'taggable')]
class Tag extends Model
{
}
