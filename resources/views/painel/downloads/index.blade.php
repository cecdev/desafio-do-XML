@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')

@stop
@section('content_header')
    <h1>
        Downloads
        <small>Lista de downloads</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/painel"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Downloads</li>
    </ol>
@stop

@section('content')


            <div class="row animated fadeInUpBig delay-1s">
                <div class="col-md-12">
                        <div class="box">
                                <div class="box-header">
                                <h3 class="box-title">TOTAL DE DOWNLOADS: <strong>{{ $conta_download }}</strong></h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">

                                  <div class="row">
                                      <div class="col-md-12">
                                            <table id="table-downloads" class="table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                      <th>CODIGO</th>
                                                      <th>NOME</th>
                                                      <th>CRIADO EM</th>
                                                      <th>FINALIZADO EM</th>
                                                      <th>STATUS</th>
                                                      <th>AÇÕES</th>
                                                    </tr>
                                                    </thead>

                                                    <tfoot>
                                                    <tr>
                                                        <th>CODIGO</th>
                                                        <th>NOME</th>
                                                        <th>CRIADO EM</th>
                                                        <th>FINALIZADO EM</th>
                                                        <th>STATUS</th>
                                                        <th>AÇÕES</th>
                                                    </tr>
                                                    </tfoot>
                                                  </table>
                                      </div>
                                  </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">

                                </div>
                        </div>
                        <!-- /.box -->
                </div>
            </div>


@stop


@section('js')

<script src="{{ asset('js/app.js') }}"></script>
<script>

jQuery(document).ready(function($){
    var mSortingString = [];
    var disableSortingColumn = 4;
    mSortingString.push({ "bSortable": false, "aTargets": [disableSortingColumn] });
    $('#table-downloads').DataTable({
        'order': [[1, 'asc']],
        'pagingType': 'full_numbers',
        'aoColumnDefs': mSortingString,
        'processing': true,
        'serverSide': true,
        'ajax':{
            'url': "{{ route('ajax.datatable.list.donloads') }}",
        },
        'columns':[
            {
                'data': 'code',
                'name': 'code'
            },
            {
                'data': 'name',
                'name': 'name'
            },
            {
                'data': 'created_at',
                'name': 'created_at'
            },
            {
                'data': 'updated_at',
                'name': 'updated_at'
            },
            {
                'data': 'process',
                'name': 'process'
            },
            {
                'data': 'action',
                'name': 'action',
                'orderable': false
            }
        ]
    });


});

</script>


@stop

