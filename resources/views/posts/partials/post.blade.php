 <div class="m-3">
     <h3><a href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->title }}</a></h3>
     <p>{{ $post->contents }}</p>
     @if ($post->comments_count)
         <p>Blog Post has {{ $post->comments_count }} comments</p>
     @else
         <p>No comments yet!</p>
     @endif
     <a href="{{ route('posts.edit', ['post' => $post]) }}" class="btn btn-primary">Edit</a>
     <form class="d-inline" action="{{ route('posts.destroy', ['post' => $post]) }}" method="POST">
         @csrf
         @method('DELETE')
         <input type="submit" value="Delete Post" class="btn btn-primary" />
     </form>
 </div>
