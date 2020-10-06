<?php

namespace Vajexal\AttributeRelations\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\HasOne;
use Vajexal\AttributeRelations\Relations\HasOneThrough;

#[HasOneThrough(Owner::class, Car::class)]
#[HasOne(Car::class)]
class Mechanic extends Model
{
}
