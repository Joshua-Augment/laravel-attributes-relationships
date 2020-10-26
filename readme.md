Laravel eloquent relationships using php 8 attributes

### Installation

```bash
composer require vajexal/laravel-attributes-relationships
```

The package will automatically register a service provider

### Usage

#### One To One
```php
use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\HasOne;

#[HasOne(Phone::class)]
class User extends Model
{
}

// ...

User::first()->phone;
```

```php
use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\BelongsTo;

#[BelongsTo(User::class)]
class Phone extends Model
{
}

// ...

Phone::first()->user;
```

#### One To Many

```php
use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\HasMany;

#[HasMany(Comment::class)]
class Post extends Model
{
}

// ...

Post::first()->comments;
```

```php
use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\BelongsTo;

#[BelongsTo(Post::class)]
class Comment extends Model
{
}

// ...

Comment::first()->post;
```

#### Many To Many

```php
use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\BelongsToMany;

#[BelongsToMany(Role::class)]
class User extends Model
{
}

// ...

User::first()->roles;
```

```php
use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\BelongsToMany;

#[BelongsToMany(User::class)]
class Role extends Model
{
}

// ...

Role::first()->users;
```

#### Has One Through
```php
use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\HasOneThrough;

#[HasOneThrough(Owner::class, Car::class)]
class Mechanic extends Model
{
}

// ...

// If you don't like method name, then you can define relation method
Mechanic::first()->owner;
```

#### Has Many Through

```php
use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\HasManyThrough;

#[HasManyThrough(Post::class, User::class)]
class Country extends Model
{
}

// ...

Country::first()->posts;
```

#### One To One (Polymorphic)

```php
use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\MorphOne;

#[MorphOne(Image::class, 'imageable')]
class User extends Model
{
}

// ...

User::first()->image;
```

```php
use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\MorphTo;

#[MorphTo('imageable')]
class Image extends Model
{
}

// ...

Image::first()->imageable;
```

#### One To Many (Polymorphic)

```php
use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\MorphMany;

#[MorphMany(Image::class, 'imageable')]
class Post extends Model
{
}

// ...

Post::first()->images;
```

```php
use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\MorphTo;

#[MorphTo('imageable')]
class Image extends Model
{
}

// ...

Image::first()->imageable;
```

#### Many To Many (Polymorphic)

```php
use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\MorphToMany;

#[MorphToMany(Tag::class, 'taggable')]
class Post extends Model
{
}

// ...

Post::first()->tags;
```

```php
use Illuminate\Database\Eloquent\Model;
use Vajexal\AttributeRelations\Relations\MorphedByMany;

#[MorphedByMany(Post::class, 'taggable')]
class Tag extends Model
{
}

// ...

Tag::first()->posts;
```
