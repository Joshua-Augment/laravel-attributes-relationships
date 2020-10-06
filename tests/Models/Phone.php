<?php

namespace Vajexal\AttributeRelations\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\BelongsTo;

#[BelongsTo(User::class)]
class Phone extends Model
{
}
