@extends('admin')

@section('head')

    <link href="{{ asset('web_assets/admin/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"

        type="text/css" />

    <link href="{{ asset('web_assets/admin/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"

        rel="stylesheet" type="text/css" />

    <style>

        .feature {

            max-width: 250px;

            width: 60px;

            border-radius: 50%;

        }



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

                    <h4 class="header-title">UsersTable</h4>



                    <table id="users_table" class="table dt-responsive nowrap w-100  order-column">

                        <thead>

                            <tr>

                                <th>Sr.</th>

                                <th>Name</th>

                                <th>PDF</th>

                            </tr>

                        </thead>



                        <tbody>
                            @foreach ($signature_pdf as $sign)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td> 
                                    <td>{{ $sign->name }}</td>
                            
                                    <td>
                                        @if (count($files) > 0)
                                                
                                                    @foreach ($files  as $pdfFile)
                                                       
                                                       @if ($pdfFile->getFilename() == $sign->pdf)
                                                           
                                                       
                                                        <a href="{{ asset('pdf/' . $pdfFile->getFilename()) }}" target="_blank">
                                                            {{ $pdfFile->getFilename() }}
                                                        </a>
                                                        
                                                    @endif
                                                                    
                                                    @endforeach
                                            
                                            @else
                                                <p>No PDF files found.</p>
                                        @endif
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

    <script defer src="{{ asset('web_assets/admin/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>

    <script defer src="{{ asset('web_assets/admin/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>

    <script defer src="{{ asset('web_assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}">

    </script>

    <script>

        $(document).ready(function() {

            $("#users_table").dataTable();

        });

    </script>

@endsection

