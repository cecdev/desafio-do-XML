@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')

@stop
@section('content_header')
    <h1>
        Dashboard
        <small>Lista de empresas</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
@stop

@section('content')

<div class="row">
        <div class="col-md-12">
                <div class="box">
                        <div class="box-header">
                        <h3 class="box-title"></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                            <div class="col-md-6">

                                <button type="button" class="btn btn-success btn-block btn-lg" data-toggle="modal" data-target="#modal-cadastro-zip">
                                        Exportar XML das empresas em .ZIP
                                      </button>
                            </div>
                                <div class="col-md-6"><button disabled="disabled"  class="btn btn-primary btn-block btn-lg">Cadastrar empresa</button></div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                </div>
                <!-- /.box -->
        </div>
    </div>


    <div class="modal fade" id="modal-cadastro-zip">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Defina um nome para controle do download</h4>
                </div>
                <div class="modal-body">
                    <div id="not-process">
                            <p><input class="form-control input-lg name-download" type="text" placeholder="Defina um nome para seu download"></p>
                            <p>Obs. Esse nome é para o seu controle pessoal em nossa tabela de downloads. Os nomes dos arquivos .zip são gerados com base na data e horario e id do usuario solicitante</p>
                            <p>
                                  <div class="alert alert-danger alert-dismissible alert-download">

                                          <h4><i class="icon fa fa-ban"></i> Erro!</h4>
                                          É nescessário definir um nome para seu controle do download com mais de 2 caracteres.
                                        </div>
                            </p>
                    </div>

                  <div id="process">
                        <h2 class="text-center"><i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i> Processando...</h2>

                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary action-donload">Preparar download</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->


            <div class="row animated fadeInUpBig delay-1s">
                <div class="col-md-12">
                        <div class="box">
                                <div class="box-header">
                                <h3 class="box-title">TOTAL DE EMPRESAS CADASTRADAS: <strong>{{ $conta_empresas }}</strong></h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                                <div class="callout callout-warning">
                                                        <h4>Atenção!</h4>

                                                        <p>Os dados presentes nessa tabela, não são veridicos, foram gerados usando alguns metodos de fake-generate.</p>
                                                      </div>
                                        </div>
                                    </div>
                                  <div class="row">
                                      <div class="col-md-12">
                                            <table id="table-empresas" class="table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                      <th>CNPJ</th>
                                                      <th>RAZAO SOCIAL</th>
                                                      <th>CIDADE</th>
                                                      <th>ESTADO</th>
                                                      <th>SITUAÇÃO</th>
                                                      <th>ABERTURA</th>
                                                      <th>AÇÕES</th>
                                                    </tr>
                                                    </thead>

                                                    <tfoot>
                                                    <tr>
                                                            <th>CNPJ</th>
                                                            <th>RAZAO SOCIAL</th>
                                                            <th>CIDADE</th>
                                                            <th>ESTADO</th>
                                                            <th>SITUAÇÃO</th>
                                                            <th>ABERTURA</th>
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
    $('#table-empresas').DataTable({
        'order': [[1, 'asc']],
        'pagingType': 'full_numbers',
        'aoColumnDefs': mSortingString,
        'processing': true,
        'serverSide': true,
        'ajax':{
            'url': "{{ route('ajax.datatable.list.companys') }}",
        },
        'columns':[
            {
                'data': 'cnpj',
                'name': 'cnpj'
            },
            {
                'data': 'nome',
                'name': 'nome'
            },
            {
                'data': 'municipio',
                'name': 'municipio'
            },
            {
                'data': 'uf',
                'name': 'uf'
            },
            {
                'data': 'situacao',
                'name': 'situacao'
            },
            {
                'data': 'abertura',
                'name': 'abertura'
            },
            {
                'data': 'action',
                'name': 'action',
                'orderable': false
            }
        ]
    });
    $('.alert-download').hide();
    $('#process').hide();
    $('#not-process').show();
    $('.action-donload').click(function (e) {
        e.preventDefault();
        $('.alert-download').hide();
        $('#not-process').hide();
        $('#process').show();
            if($('.name-download').val().length < 3 ) {
                $('.alert-download').show();
                $('#process').hide();
                $('#not-process').show();
            }else{
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                var acao = "{{ route('ajax.create.control.download') }}";
                var data = {name: $('.name-download').val()};
                var postar = $.post(acao, data);

                postar.done(function(retorno) {
                    if(retorno.status === 'success'){
                        window.location.href = "{{ route('painel.dowload') }}";

                    }
                    $('#process').hide();
                    $('#not-process').show();
                });
                postar.fail(function(XMLHttpRequest, textStatus, errorThrown) {

                });
        }
    });



});

</script>


@stop

