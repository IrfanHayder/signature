@extends('admin')
@section('head')
@endsection
@section('content')
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Tools Audit</h4>
                    <table id="" class="table">
                        <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>Tool</th>
                                <th>Audit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tools_with_audits as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <a href="{{ route('tool.audit', ['id' => $item->id]) }}">Audit</a>
                                    </td>
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
@endsection
