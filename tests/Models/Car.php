<?php

namespace Vajexal\AttributeRelations\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\HasOne;

#[HasOne(Owner::class)]
class Car extends Model
{
}
