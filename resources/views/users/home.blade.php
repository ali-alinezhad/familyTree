@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row pull-left" style="margin-bottom: 15px;">

        </div>
        <table id="usersTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>{{ __('translations.english_name') }}</th>
                <th>{{ __('translations.persian_name') }}</th>
                <th>{{ __('translations.username') }}</th>
                <th>{{ __('translations.role') }}</th>
                <th>{{ __('translations.gender') }}</th>
                <th>{{ __('translations.action') }}</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('third_party_stylesheets')

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
@endsection

@section('third_party_scripts')


    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            $('.ui-pnotify').remove();
            $('#usersTable').DataTable({
                "iDisplayLength": 20,
                "lengthMenu": [[20, 40, 50], [20, 40, 50]],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('users.datatables.data') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {"_token": "{{ csrf_token() }}"}
                },
                "columns": [
                    {"data": "english_name"},
                    {"data": "persian_name"},
                    {"data": "username"},
                    {"data": "role"},
                    {"data": "status"},
                    {"data":"action","searchable":false,"orderable":false}
                ]

            });

            $('#usersTable').dataTable().fnFilterOnReturn();
        });
    </script>

@endsection
