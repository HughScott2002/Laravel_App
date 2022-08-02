<div class="form-group mb-3">
    <label class='form-label'for="title">Title</label>
    <input required class='form-control' type="text" name="title" id="title"
        value="{{ old('title', optional($post ?? null)->title) }}" />
    <div class="alert alert-danger my-2 p-2 invalid-feedback">The title feild is required</div>
    <div class="alert alert-success my-2 p-2 valid-feedback">Input vaild</div>

    @error('title')
        <div class="alert alert-danger my-2 p-2">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label class='form-label text-bold' for="thumbnail">Thumbnail</label>
    <input class='form-control' type="file" name="thumbnail" id="thumbnail" required multiple />
    <div class="alert alert-danger my-2 p-2 invalid-feedback">Please Upload a file</div>
    <div class="alert alert-success my-2 p-2 valid-feedback">Input vaild</div>
    @error('thumbnail')
        <div class="alert alert-danger my-2 p-2">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label class='form-label text-bold' for="content">Content</label>
    <textarea required class='form-control ' name="content" id="content"cols="30" rows="10"
        style="resize: none;">{{ old('content', optional($post ?? null)->content) }}</textarea>
    <div class="alert alert-danger my-2 p-2 invalid-feedback">The content feild is required</div>
    <div class="alert alert-success my-2 p-2 valid-feedback">Input vaild</div>
    @error('content')
        <div class="alert alert-danger my-2 p-2">{{ $message }}</div>
    @enderror
</div>


{{-- <div class="d-flex justify-content-center"> --}}
<div class="d-grid">
    <button type="submit" class="btn btn-primary btn-block py-2">Submit</button>
</div>



{{-- <label for="content">Content</label>
<br />
@error('content')
    <div>{{ $message }}</div>
@enderror
<br />
<br /> --}}
{{-- @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
