<?php

namespace Vajexal\AttributeRelations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use ReflectionAttribute;
use ReflectionObject;
use Vajexal\AttributeRelations\Relations\RelationAttribute;

class AttributeRelationsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Event::listen('eloquent.booted:*', function (string $eventName, array $data) {
            $model = $data[0];

            $reflection = new ReflectionObject($model);
            $attributes = $reflection->getAttributes(RelationAttribute::class, ReflectionAttribute::IS_INSTANCEOF);

            foreach ($attributes as $attribute) {
                /** @var RelationAttribute $relation */
                $relation = $attribute->newInstance();

                $model::resolveRelationUsing($relation->guessRelationName(), function (Model $model) use ($relation): Relation {
                    $method = lcfirst(class_basename(get_class($relation)));

                    return $model->{$method}(...$relation->getArguments());
                });
            }
        });
    }
}
