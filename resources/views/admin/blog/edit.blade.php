@extends('admin')
@section('head')
    <style>
        .tox .tox-notification--warn,
        .tox .tox-notification--warning {
            display: none !important;
        }

        .images_row {
            background: transparent;
            row-gap: 0.5em;
        }

        .images_row div.image-box {
            background: gainsboro;
        }

        .img-fluid.rounded {
            height: 150px;
            object-fit: contain;
            width: 100%;
            background: #8080802e;
            padding: 5px;
        }

        .feature_img_preview img {
            max-width: 300px;
            width: 100%;
            object-fit: contain;
        }
    </style>
@endsection
@section('content')
    <div class="row mt-4">

        <div class="card">
            <div class="card-body pt-0">
                <div class="message">

                </div>
                <h4 class="my-3">Edit Blog:</h4>
                <form id="blog_form" action="{{ route('blog.update', ['blog' => $blog]) }}" enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <input type="hidden" name="id" value="{{ $blog->id }}">
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Blog Title"
                                value="{{ $blog->title }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" placeholder="Blog Meta Title"
                                value="{{ $blog->meta_title }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Meta Description</label>
                            <input type="text" name="meta_description" class="form-control"
                                placeholder="Blog Meta Description" value="{{ $blog->meta_description }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Slug</label>
                            <input type="text" name="slug" class="form-control" placeholder="Blog Slug"
                                value="{{ $blog->slug }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Language</label>
                            <select name="lang_key" class="form-control">
                                @foreach (config('constants.languages') as $key => $value)
                                    <option value="{{ $value }}" @if ($blog->lang_key == $value) selected @endif>
                                        {{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Parent</label>
                            <select name="parent_id" class="form-control">
                                <option value="0" selected>This is parent</option>
                                @if ($parents->count() > 0)
                                    @foreach ($parents as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($blog->parent_id == $item->id) selected @endif>{{ $item->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="blog" class="form-label">Status</label>
                            <select class="form-select" id="" name="pinch">
                                <option selected disabled>Add To Pinch</option>
                                <option value="1" @if ($blog->status == 1) selected @endif>True</option>
                                <option value="0" @if ($blog->status == 0) selected @endif>False</option>
                            </select>
                        </div>
                        <div class=" col-md-12 mb-3">
                            <label for="contact" class="form-label">Detail</label>
                            <input class="form-control tool_textarea" name="blog_detail" id="blog_textarea"
                                value="{{ $blog->detail }}" />
                        </div>
                        <div class="col-md-12">
                            <label for="contact" class="form-label">Featured Image URL</label>
                            <x-media :images="$images" name="featured_img" :imageId="$blog->img_id" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <div>
                                <x-gallary :images="$images" />
                            </div>
                        </div>
                    </div>
                    <div style="text-align: right">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            Submit
                        </button>
                    </div>
                </form>
            </div> <!-- end card-body -->
        </div>
    </div>
    <!-- Full width modal content -->

    <!-- /.modal -->
@endsection
@section('script')
    {{-- TINYMCE SCRIPT --}}
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/jquery.tinymce.min.js" referrerpolicy="origin"></script>
    {{-- TINYMCE SCRIPT END --}}

    <script src="{{ asset('web_assets/admin/js/tinymce-script.js') }}"></script>
@endsection
