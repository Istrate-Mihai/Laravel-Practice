<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Comment;

class PostTest extends TestCase
{
  use RefreshDatabase;

  public function testNoBlogPostsMessageWhenThereAreNone()
  {
    $response = $this->get('/posts');

    $response->assertSeeText('No posts found!');
  }

  public function test1BlogPostWhenThereIs1WithNoComments()
  {
    // Arrange
    $post = $this->createDummyBlogPost();
    // Act
    $response = $this->get('/posts');
    // Assert
    $response->assertSeeText('Blog Post Title');
    $response->assertSeeText('No comments yet!');
    $this->assertDatabaseHas('blog_posts', [
      'title' => 'Blog Post Title'
    ]);
  }

  public function testSee1BlogPostWithComments()
  {
    $post = $this->createDummyBlogPost();
    Comment::factory()->count(4)->create([
      'blog_post_id' => $post->id
    ]);
    $response = $this->get('/posts');
    $response->assertSeeText('4 comments');
  }

  public function testStoreValid()
  {
    $params = [
      'title' => 'Valid Title',
      'content' => 'At least 10 characters'
    ];

    $this->actingAs($this->user())
      ->post('/posts', $params)
      ->assertStatus(302)
      ->assertSessionHas('status');

    $this->assertEquals(session('status'), 'BlogPost was successfully created!');
  }

  public function testStoreFail()
  {
    $params = [
      'title' => 'x',
      'content' => 'x'
    ];

    $this->actingAs($this->user())
      ->post('/posts', $params)
      ->assertStatus(302)
      ->assertSessionHas('errors');

    $messages = session('errors');
    $messages = $messages->getMessages();
    $this->assertEquals($messages['title'][0], 'The title must be at least 5  characters.');
    $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');
  }

  public function testUpdateValid()
  {
    $post = $this->createDummyBlogPost();
    $params = [
      'title' => 'A new named title',
      'content' => 'Content was changed'
    ];

    $this->actingAs($this->user())
      ->put("/posts/{$post->id}", $params)
      ->assertStatus(302)
      ->assertSessionHas('status');

    $this->assertDatabaseMissing('blog_posts', $post->toArray());
    $this->assertDatabaseHas('blog_posts', [
      'title' => 'A new named title'
    ]);
  }

  public function testDelete()
  {
    $post = $this->createDummyBlogPost();
    $this->actingAs($this->user())
      ->delete("/posts/{$post->id}")
      ->assertStatus(302)
      ->assertSessionHas('status');

    $this->assertDatabaseMissing('blog_posts', $post->toArray());
    $this->assertEquals(session('status'), 'BlogPost was successfully deleted!');
  }

  private function createDummyBlogPost(): BlogPost
  {
    // $post = new BlogPost();
    // $post->title = 'Blog Post Title';
    // $post->content = 'Blog Post Content';
    // $post->save();
    // return $post;

    return BlogPost::factory()->configure()->create();
  }
}
