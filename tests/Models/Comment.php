<?php

namespace Vajexal\AttributeRelations\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\BelongsTo;

#[BelongsTo(Post::class)]
class Comment extends Model
{
}
