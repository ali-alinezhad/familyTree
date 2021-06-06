@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{ __('translations.users') }}</h1>
    </div>

    <div class="container-fluid">
        <div class="row pull-left" style="margin-bottom: 15px;">

        </div>
        <table id="messageTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>Message Sender</th>
                <th>Subject</th>
                <th>Date and Time</th>
                <th>Status</th>
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
            $('#messageTable').DataTable({
                "iDisplayLength": 20,
                "lengthMenu": [[20, 40, 50], [20, 40, 50]],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('message.datatables.data') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {"_token": "{{ csrf_token() }}"}
                },
                "columns": [
                    {"data": "sender"},
                    {"data": "subject"},
                    {"data": "created_at"},
                    {"data": "status"},
                    {"data":"action","searchable":false,"orderable":false}
                ]

            });

            $('#messageTable').dataTable().fnFilterOnReturn();
        });
    </script>

@endsection
