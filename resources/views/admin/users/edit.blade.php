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
                <h4 class="my-3">Update User:</h4>
                <form id="update_admin_form" method="POST" action="{{ route('user.update', ['user' => $user]) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name"
                                value="{{ $user->name }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email"
                                value="{{ $user->email }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password"
                                value="" required>
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
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('label').on('click', function() {
                $(this).next().focus();
            });

        });
    </script>
@endsection
