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
    $post = new BlogPost();
    $post->title = 'Blog Post Title';
    $post->contents = 'Blog Post Contents';
    $post->save();
    // Act
    $response = $this->get('/posts');
    // Assert
    $this->assertDatabaseHas('blog_posts', [
      'title' => 'Blog Post Title'
    ]);
    $response->assertSeeText('Blog Post Title');
  }
}
