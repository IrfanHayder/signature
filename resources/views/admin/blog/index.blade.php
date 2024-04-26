@extends('admin')
@section('head')
    <link href="{{ asset('web_assets/admin/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('web_assets/admin/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <style>
        .feature {
            max-width: 250px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Blog Data Table</h4>

                    <table id="blog_table" class="table w-100">
                        <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>Title</th>
                                <th>Parent / Language</th>
                                <th>Feature Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($blogs as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>
                                        @if ($item->id != $item->parent_id)
                                            {{ $item->parent->title }}
                                        @else
                                            Itself
                                        @endif
                                        / {{ $item->lang_key }}
                                    </td>
                                    <td>
                                        @php
                                            $path = App\Models\Media::get_column($item->img_id, 'path');
                                        @endphp
                                        @if ($path)
                                            <img class="feature" src="{{ asset("$path") }}" alt="image">
                                        @endif
                                    </td>
                                    <td>

                                        <a class="btn btn-info" href="{{ route('blog.edit', ['blog' => $item]) }}">
                                            EDIT
                                        </a>
                                        @can('super_admin')
                                            <form action="{{ route('blog.destroy', ['blog' => $item]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">TRASH</button>
                                            </form>
                                        @endcan

                                    </td>
                                </tr>
                            @empty
                            @endforelse

                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script defer src="{{ asset('web_assets/admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script defer src="{{ asset('web_assets/admin/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script defer src="{{ asset('web_assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script>
        $(document).ready(function() {
            $("#blog_table").dataTable();
        });
    </script>
@endsection
