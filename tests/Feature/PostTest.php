<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
  use RefreshDatabase;

  public function testNoBlogPostsMessageWhenThereAreNone()
  {
    $response = $this->get('/posts');

    $response->assertSeeText('No posts found!');
  }

  public function test1BlogPostWhenThereIs1()
  {
    // Arrange
    $post = $this->createDummyBlogPost();
    // Act
    $response = $this->get('/posts');
    // Assert
    $this->assertDatabaseHas('blog_posts', [
      'title' => 'Blog Post Title'
    ]);
    $response->assertSeeText('Blog Post Title');
  }

  public function testStoreValid()
  {
    $params = [
      'title' => 'Valid Title',
      'contents' => 'At least 10 characters'
    ];
    $this->post('/posts', $params)->assertStatus(302)->assertSessionHas('status');
    $this->assertEquals(session('status'), 'BlogPost was successfully created!');
  }

  public function testStoreFail()
  {
    $params = [
      'title' => 'x',
      'contents' => 'x'
    ];

    $this->post('/posts', $params)->assertStatus(302)->assertSessionHas('errors');
    $messages = session('errors');
    $messages = $messages->getMessages();
    $this->assertEquals($messages['title'][0], 'The title must be at least 5  characters.');
    $this->assertEquals($messages['contents'][0], 'The contents must be at least 10 characters.');
  }

  public function testUpdateValid()
  {
    $post = $this->createDummyBlogPost();
    $params = [
      'title' => 'A new named title',
      'contents' => 'Content was changed'
    ];

    $this->put("/posts/{$post->id}", $params)->assertStatus(302)->assertSessionHas('status');
    $this->assertDatabaseMissing('blog_posts', $post->toArray());
    $this->assertDatabaseHas('blog_posts', [
      'title' => 'A new named title'
    ]);
  }

  public function testDelete()
  {
    $post = $this->createDummyBlogPost();
    $this->delete("/posts/{$post->id}")
      ->assertStatus(302)
      ->assertSessionHas('status');
    $this->assertDatabaseMissing('blog_posts', $post->toArray());
    $this->assertEquals(session('status'), 'BlogPost was successfully deleted!');
  }

  private function createDummyBlogPost(): BlogPost
  {
    $post = new BlogPost();
    $post->title = 'Blog Post Title';
    $post->contents = 'Blog Post Contents';
    $post->save();

    return $post;
  }
}
