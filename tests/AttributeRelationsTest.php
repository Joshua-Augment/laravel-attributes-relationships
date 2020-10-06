<?php

namespace Vajexal\AttributeRelations\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase;
use Vajexal\AttributeRelations\AttributeRelationsServiceProvider;
use Vajexal\AttributeRelations\Tests\Models\Car;
use Vajexal\AttributeRelations\Tests\Models\Comment;
use Vajexal\AttributeRelations\Tests\Models\Country;
use Vajexal\AttributeRelations\Tests\Models\Image;
use Vajexal\AttributeRelations\Tests\Models\Mechanic;
use Vajexal\AttributeRelations\Tests\Models\Owner;
use Vajexal\AttributeRelations\Tests\Models\Phone;
use Vajexal\AttributeRelations\Tests\Models\Post;
use Vajexal\AttributeRelations\Tests\Models\Role;
use Vajexal\AttributeRelations\Tests\Models\Tag;
use Vajexal\AttributeRelations\Tests\Models\User;

class AttributeRelationsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
    }

    protected function getPackageProviders($app)
    {
        return [AttributeRelationsServiceProvider::class];
    }

    public function testHasOne()
    {
        $user  = User::create();
        $phone = $user->phone()->save(new Phone);

        $this->assertTrue($phone->is($user->phone));
        $this->assertTrue($user->is($phone->user));
    }

    public function testHasMany()
    {
        $post    = Post::create();
        $comment = $post->comments()->save(new Comment);

        $this->assertCount(1, $post->comments);
        $this->assertTrue($comment->is($post->comments[0]));
        $this->assertTrue($post->is($comment->post));
    }

    public function testBelongsToMany()
    {
        $user = User::create();
        $role = Role::create();

        $user->roles()->attach($role);

        $this->assertCount(1, $user->roles);
        $this->assertTrue($role->is($user->roles[0]));
        $this->assertCount(1, $role->users);
        $this->assertTrue($user->is($role->users[0]));
    }

    public function testHasOneThrough()
    {
        $mechanic = Mechanic::create();
        $car      = $mechanic->car()->save(new Car);
        $owner    = $car->owner()->save(new Owner);

        $this->assertTrue($owner->is($mechanic->owner));
    }

    public function testHasManyThrough()
    {
        $country = Country::create();
        $user    = $country->users()->save(new User);
        $post    = $user->posts()->save(new Post);

        $this->assertCount(1, $country->posts);
        $this->assertTrue($post->is($country->posts[0]));
    }

    public function testMorphOne()
    {
        $user  = User::create();
        $image = $user->image()->save(new Image);

        $this->assertTrue($user->is($image->imageable));
        $this->assertTrue($image->is($user->image));
    }

    public function testMorphMany()
    {
        $post  = Post::create();
        $image = $post->images()->save(new Image);

        $this->assertCount(1, $post->images);
        $this->assertTrue($image->is($post->images[0]));
        $this->assertTrue($post->is($image->imageable));
    }

    public function testMorphToMany()
    {
        $post = Post::create();
        $tag  = Tag::create();

        $post->tags()->attach($tag);

        $this->assertCount(1, $post->tags);
        $this->assertTrue($tag->is($post->tags[0]));
        $this->assertCount(1, $tag->posts);
        $this->assertTrue($post->is($tag->posts[0]));
    }
}
