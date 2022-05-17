@if ($errors->any())
    <div class="m-3">
        <ul class="list-group">
            @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for="title">Post Title</label>
    <input id="title" name="title" class="form-control" type="text"
        value="{{ old('title', optional($post ?? null)->title) }}" />
    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="contents">Post Contents</label>
    <textarea id="contents" name="contents"
        class="form-control">{{ old('contents', optional($post ?? null)->contents) }}</textarea>
    @error('contents')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
