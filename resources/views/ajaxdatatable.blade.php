@extends('layouts.app')

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Customers</div>

                    <div class="panel-body">
                        <table class="table" id="datatable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('api.users') }}",
                "columns": [
                    { "data": "name" },
                    { "data": "email" },
                    { "data": "created_at" }
                ]
            });
        });
    </script>
@endsection
