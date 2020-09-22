<?php

    $servidor="localhost";
    $usuario="root";
    $senha="";
    $dbname="sorteio_db";
    //criando a conexão
    $conn=mysqli_connect($servidor, $usuario, $senha, $dbname) or die ("erro");


    $nome_sorteio = '';

    //recebe os dados do formulario

    if(isset( $_POST['nomesorteio']) ){
        $nome_sorteio = $_POST['nomesorteio'];
        $mini_desc = $_POST['mini-desc'];
        $descricao_sorteio = $_POST['descricao'];
        $cpu = (float)$_POST['cpu'];
        $quant_rifas = (int)$_POST['quantrifas'];
        $data_sorteio = $_POST['datasorteio'];
        


        $verificarExistenciaNome = "SELECT * from tbl_sorteios where nome_sorteio = '$nome_sorteio'";
        $validar = mysqli_query($conn, $verificarExistenciaNome);
        $linhasRetornadas = mysqli_num_rows($validar);
        if($linhasRetornadas == 0){
            //echo"tudo ok";
        }else{
            echo("<script>console.log('nome de sorteio já existente. favor colocar outro nome')</script>");
            echo("este nome de sorteio já esta sedo usado e nao pode ser duplicado! tente outro nome :)");
            echo("<a href='./tela-adm-rifas.php'>Tentar Novamente</a>");
            exit(0);
        }


    


        $img1 = '';
        $img2 = '';
        $img3 = '';
        $img4 = '';
        $img5 = '';

        if(empty($_FILES['img1']['name'])){
            //echo("img1 is empty!");
        }else{
            //echo("is not empty");
            $extensao = strtolower(substr($_FILES['img1']['name'], -4));
            $novo_nome = md5(time()) . $extensao;
            $img1 = $novo_nome;
            $diretorio = public_path('imagens\sorteios');
            //$diretorio = "../../upload/"; //diretorio dos arquivos
            move_uploaded_file($_FILES['img1']['tmp_name'], $diretorio."/".$novo_nome);
            $sql_code = "insert into imagens (arquivo, data) values ('$novo_nome', NOW())";
            $executando = mysqli_query($conn, $sql_code);

            
        }

        sleep(1);

        //-------------------

        if(empty($_FILES['img2'])){
            //echo("img2 is empty!");
        }else{
            //echo("is not empty");
            $extensao = strtolower(substr($_FILES['img2']['name'], -4));
            $novo_nome = md5(time()) . $extensao;
            $img2 = $novo_nome;
            $diretorio = public_path('imagens\sorteios');
            //$diretorio = "../../upload/"; //diretorio dos arquivos
            move_uploaded_file($_FILES['img2']['tmp_name'], $diretorio."/".$novo_nome);
            $sql_code = "insert into imagens (arquivo, data) values ('$novo_nome', NOW())";
            $executando = mysqli_query($conn, $sql_code);
            
        }
        sleep(1);
        //-----------------------

        if(empty($_FILES['img3'])){
            //echo("img3 is empty!");
        }else{
            //echo("is not empty");
            $extensao = strtolower(substr($_FILES['img3']['name'], -4));
            $novo_nome = md5(time()) . $extensao;
            $img3 = $novo_nome;
            $diretorio = public_path('imagens\sorteios');
            //$diretorio = "../../upload/"; //diretorio dos arquivos
            move_uploaded_file($_FILES['img3']['tmp_name'], $diretorio."/".$novo_nome);
            $sql_code = "insert into imagens (arquivo, data) values ('$novo_nome', NOW())";
            $executando = mysqli_query($conn, $sql_code);

            
            
        }

        sleep(1);
        //---------------------------------------------------

        if(empty($_FILES['img4'])){
            //echo("img4 is empty!");
        }else{
            //echo("is not empty");
            $extensao = strtolower(substr($_FILES['img4']['name'], -4));
            $novo_nome = md5(time()) . $extensao;
            $img4 = $novo_nome;
            $diretorio = public_path('imagens\sorteios');
            //$diretorio = "../../upload/"; //diretorio dos arquivos
            move_uploaded_file($_FILES['img4']['tmp_name'], $diretorio."/".$novo_nome);
            $sql_code = "insert into imagens (arquivo, data) values ('$novo_nome', NOW())";
            $executando = mysqli_query($conn, $sql_code);
            
        }
        sleep(1);
        //------------------------------------------

        if(empty($_FILES['img5'])){
            //echo("img5 is empty!");
        }else{
            //echo("is not empty");
            $extensao = strtolower(substr($_FILES['img5']['name'], -4));
            $novo_nome = md5(time()) . $extensao;
            $img5 = $novo_nome;
            $diretorio = public_path('imagens\sorteios');
            //$diretorio = "../../upload/"; //diretorio dos arquivos
            move_uploaded_file($_FILES['img5']['tmp_name'], $diretorio."/".$novo_nome);
            $sql_code = "insert into imagens (arquivo, data) values ('$novo_nome', NOW())";
            $executando = mysqli_query($conn, $sql_code);

            
        }



        








    //gravar tudas informações na tbl_sorteios
        $userId = Auth::id(); //pegar o id do usuario logado para salvar o sorteio feito por ele
        @$insere = "INSERT INTO tbl_sorteios (nome_sorteio, usr_responsavel_id, descricao_sorteio, quant_rifas, data_sorteio, img1, img2, img3, img4, img5, status, mini_desc, valor_por_unidade)
        VALUES ('$nome_sorteio', '$userId', '$descricao_sorteio', '$quant_rifas', '$data_sorteio', '$img1', '$img2', '$img3', '$img4', '$img5', 'Ativo', '$mini_desc', '$cpu')";

        $resultado = mysqli_query($conn, $insere);


    //criação da tbl especifica do sorteio :)
        $nome_sorteio_com_underline = str_replace(" ", "_", $nome_sorteio);
        //$depoisdecriar = "alter table $nome_sorteio_com_underline add foreign key (telefone) references tbl_usuario (telefone)";
        $formatarParaPreencherAte3Numeros = "ALTER TABLE $nome_sorteio_com_underline MODIFY numero_rifa INT(3) ZEROFILL NOT NULL";

        $novaTBL = "create table $nome_sorteio_com_underline (
            id int not null,
            numero_rifa int null,
            nome_reserva text null,
            data_reserva date null,
            nome_compra_confirmada text null,
            data_compra_confirmada date null,
            telefone text null,
            primary key (numero_rifa)
            )";
            
        $createTable = mysqli_query($conn, $novaTBL);
        //$createTable = mysqli_query($conn, $depoisdecriar);
        $createTable = mysqli_query($conn, $formatarParaPreencherAte3Numeros);

        //saber qual codigo do sorteio foi gerado ao criar o cadastro do sorteio
        $selectCodSorteio = "SELECT id, nome_sorteio FROM tbl_sorteios WHERE nome_sorteio = '$nome_sorteio'";
        $createTable = mysqli_query($conn, $selectCodSorteio);
        $array = mysqli_fetch_assoc($createTable);
        sleep(1);
        //var_dump($array);
        

        //settando o tempo de execução maximo de um script
        set_time_limit(480);


        if(isset($array['id']) && $quant_rifas == '1000'){
            $codSorteio = $array['id'];
            for($i=0;$i<=999;$i++){
                $populartbl = "INSERT INTO $nome_sorteio_com_underline (id, numero_rifa, nome_reserva, data_reserva, nome_compra_confirmada, data_compra_confirmada, telefone) VALUES ('$codSorteio', '$i', null, null, null, null, null)";
                $createTable = mysqli_query($conn, $populartbl);
        
            }

        }else{
            if(isset($array['id']) && $quant_rifas == '100'){
                $codSorteio = $array['id'];
                for($i=0;$i<=99;$i++){
                    $populartbl = "INSERT INTO $nome_sorteio_com_underline (id, numero_rifa, nome_reserva, data_reserva, nome_compra_confirmada, data_compra_confirmada, telefone) VALUES ('$codSorteio', '$i', null, null, null, null, null)";
                    $createTable = mysqli_query($conn, $populartbl);
            
                }
        
            }	
        }

    }


?>


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Criar Sorteio') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <div>
                   
                        <form method='POST' action='#' enctype='multipart/form-data'>
                            @csrf
		                    <div class="form">
			                    <div class="form-group">
                                    <label for="nomesorteio">Nome do Sorteio</label>
                                    <input class="form-control" name='nomesorteio' id="nomesorteio" placeholder='Nome do Sorteio' type='text' required ><br>
                                    <label for="mini-desc">MINI DESCRIÇÃO DO SORTEIO:</label>
                                    <input class="form-control" name="mini-desc" id="mini-desc" placeholder="Mini Descrição" type="text" require ><br>
                                    <label for="descricao">DESCRIÇÃO DO SORTEIO:</label>
                                    <textarea class="form-control" name='descricao' id="descricao" placeholder='Descrição do Sorteio' type='text' required></textarea><br>
                                    <label for="quantrifas">QUANTIDADE DE RIFAS:</label>
                                    <select class="form-control" name="quantrifas" id="">
                                        <option value="100">100 unidades (0 - 99)</option>
                                        <option value="1000" selected>1000 unidades (0 - 999)</option>
                                    </select>
                                    <br>
                                    <label for="cpu">VALOR POR UNIDADE:</label>
                                    <input class="form-control" name='cpu' placeholder='Valor por unidade' type='float' required><br>
                                    <label for="datasorteio">DATA PREVISTA DO SORTEIO:</label>
                                    <input class="form-control" name='datasorteio' placeholder='Data do Sorteio' type='date' required ><br>
                                    
                                    <label for="img1">FOTO DO BANNER DO SORTEIO:</label>
                                    <input data-show-upload="false" data-browse-on-zone-click="true" class="file" type='file' name='img1' id='img1' required /><br>
                                    
                                    
                                    <label>FOTOS PARA SLIDE 1:</label>
                                    <input data-show-upload="false" data-browse-on-zone-click="true" class="file" type='file' name='img2' id='img2' required /><br>
                                    <label>FOTOS PARA SLIDE 2:</label>
                                    <input data-show-upload="false" data-browse-on-zone-click="true" class="file" type='file' name='img3' id='img3' required /><br>
                                    <label>FOTOS PARA SLIDE 3:</label>
                                    <input data-show-upload="false" data-browse-on-zone-click="true" class="file" type='file' name='img4' id='img4' required /><br>
                                    <label>FOTOS PARA SLIDE 4:</label>
                                    <input data-show-upload="false" data-browse-on-zone-click="true" class="file" type='file' name='img5' id='img5' required /><br>
                                    
                                    <button class="btn btn-primary" type='subit'>Criar Sorteio</button>
                                    <button class="btn btn-primary" onclick="window.location.href = 'home'">Voltar</button>
			                    </div>

                                
                                
		                    </div>
                        </form>

                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
