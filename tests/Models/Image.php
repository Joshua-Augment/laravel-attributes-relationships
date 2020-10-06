<?php

namespace Vajexal\AttributeRelations\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\MorphTo;

#[MorphTo('imageable')]
class Image extends Model
{
}
