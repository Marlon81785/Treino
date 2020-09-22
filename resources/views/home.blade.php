@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <div>
                   
                       <button class="btn btn-block btn-primary" onclick="window.location.href = 'criarSorteio'">Criar novo Sorteio</button>
                       <button class="btn btn-block btn-primary" onclick="window.location.href = 'gerenciar'">Gerenciar meus sorteios</button>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
