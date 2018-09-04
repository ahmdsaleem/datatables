@extends('layouts.app')

@section('stylesheets')
    <link rel="stylesheet" href="css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
            <button type="button"
                    class="btn btn-inline btn-primary"
                    data-toggle="modal"
                    data-target="#create-user">
                Create New User
            </button>

            <div class="modal fade"
                 id="create-user"
                 tabindex="-1"
                 role="dialog"
                 aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                                <i class="font-icon-close-2"></i>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Create New User</h4>
                        </div>
                        <div class="modal-body">
                            <form id="form-signup_v1" name="form-signup_v1" method="POST">
                                {{ csrf_field() }}
                                <span id="form_output"></span>
                                <div class="form-group">
                                    <label class="form-label" for="signup_v1-username">Username</label>
                                    <div class="form-control-wrapper">
                                        <input id="signup_v1-username"
                                               class="form-control"
                                               name="username"
                                               type="text" data-validation="[L>=5, L<=18, MIXED]"
                                               data-validation-message="$ must be between 5 and 18 characters. No special characters allowed."
                                               data-validation-regex="/^((?!admin).)*$/i"
                                               data-validation-regex-message="The word &quot;Admin&quot; is not allowed in the $">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="signup_v1-email">Email</label>
                                    <div class="form-control-wrapper">
                                        <input id="signup_v1-email"
                                               class="form-control"
                                               name="email"
                                               type="text"
                                               data-validation="[EMAIL]">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="signup_v1-password">Password</label>
                                    <div class="form-control-wrapper">
                                        <input id="signup_v1-password"
                                               class="form-control"
                                               name="password"
                                               type="password" data-validation="[L>=6]"
                                               data-validation-message="$ must be at least 6 characters">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="signup_v1-password-confirm">Confirm Password</label>
                                    <div class="form-control-wrapper">
                                        <input id="signup_v1-password-confirm"
                                               class="form-control"
                                               name="password-confirm"
                                               type="password" data-validation="[V==password]"
                                               data-validation-message="$ does not match the password">
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                            <button id="save" class="btn btn-rounded btn-primary" >Save User</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div><!--.modal-->
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Customers</div>

                    <div class="panel-body">
                        <table class="table" id="datatable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th></th>
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
    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/tether/tether.min.js"></script>
    <script src="js/lib/bootstrap/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script>
        var table;
        $(document).ready( function () {
          table =  $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('api.users') }}",
                "columns": [
                    { data : 'id', name : 'id'},
                    { data: 'name' , name: 'name'},
                    { data: 'email' , name : 'email' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

            $('#save').click(function(){
                alert('hey it works');
                event.preventDefault();
                $.ajaxSetup({
                    header:$('meta[name="_token"]').attr('content')
                })
                var form_data = $('#form-signup_v1').serialize();
                $.ajax({
                    url:"{{ route('user.store') }}",
                    method:"POST",
                    data:form_data,
                    dataType:"json",
                    success:function(data)
                    {
                            $('#datatable').DataTable().ajax.reload();
                    }
                })
            });




        });


    </script>
@endsection
