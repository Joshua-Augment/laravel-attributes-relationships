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
   protected static array $attributeCache = [];
   public function boot(): void
   {
      Event::listen('eloquent.booted:*', function (string $eventName, array $data) {
         $model = $data[0];
         $class = get_class($model);

         if (!isset(self::$attributeCache[$class])) {
            $reflection = new ReflectionObject($model);
            self::$attributeCache[$class] = $reflection->getAttributes(RelationAttribute::class, ReflectionAttribute::IS_INSTANCEOF);
         }

         foreach (self::$attributeCache[$class] as $attribute) {
            $relation = $attribute->newInstance();

            $model::resolveRelationUsing($relation->guessRelationName(), function (Model $model) use ($relation): Relation {
               $method = lcfirst(class_basename(get_class($relation)));
               return $model->{$method}(...$relation->getArguments());
            });
         }
      });
   }
}
