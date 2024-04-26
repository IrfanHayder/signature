@extends('admin')
@section('head')
    <link href="{{ asset('web_assets/admin/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('web_assets/admin/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
    <style>
        tbody tr td {
            vertical-align: middle;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Tool Audit Table</h4>

                    <table id="audit_table" class="table w-100">
                        <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>User</th>
                                <th>Event</th>
                                <th>Old Value</th>
                                <th>New Value</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($audits as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ App\Models\User::find($item->user_id)->name }}</td>
                                    <td>{{ Str::upper($item->event) }}</td>
                                    <td>
                                        <textarea class="form-control">
                                            {{ json_encode($item->old_values) }}
                                        </textarea>
                                    </td>
                                    <td>
                                        <textarea class="form-control">
                                            {{ json_encode($item->new_values) }}
                                        </textarea>
                                    </td>
                                    <td>{{ Carbon\Carbon::parse($item['updated_at'])->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
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
            $("#audit_table").dataTable();
        });
    </script>
@endsection
