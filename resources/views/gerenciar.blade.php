<?php
    $servidor="localhost";
    $usuario="root";
    $senha="";
    $dbname="sorteio_db";
    //criando a conexão
    $conn=mysqli_connect($servidor, $usuario, $senha, $dbname) or die ("erro");


    $userId = Auth::id();

    $verificarExistenciaSorteio = "SELECT * from tbl_sorteios where usr_responsavel_id = '$userId'";
    $validar = mysqli_query($conn, $verificarExistenciaSorteio);
    $linhasRetornadas = mysqli_num_rows($validar);
    if($linhasRetornadas == 0){
        //nenhum sorteio registrado ainda
    }
        
        
        
        
    
    




    
?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Gerenciador de Sorteios') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nome do Sorteio</th>
                                    <th>N° unidades</th>
                                    <th>Data Prevista Sorteio</th>
                                    <th>Status</th>
                                    <th>Valor por unidade</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @while($sorteios = mysqli_fetch_assoc($validar))
                                <tr>
                                    <td><a href="/sorteio?nSorteio={{ ($sorteios['nome_sorteio']) }}">{{ ($sorteios['nome_sorteio']) }}</a></td>
                                    <td>{{ ($sorteios['quant_rifas']) }}</td>
                                    <td>{{ ($sorteios['data_sorteio']) }}</td>
                                    <td>{{ ($sorteios['status']) }}</td>
                                    <td>{{ ($sorteios['valor_por_unidade']) }}</td>
                                    <td><button type="button" class="btn btn-success">Compartilhar Link</button></td>
                                </tr>
                                @endwhile
                            </tbody>

                        </table>

                   
                      
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
