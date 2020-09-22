<?php
    $servidor="localhost";
    $usuario="root";
    $senha="";
    $dbname="sorteio_db";
    //criando a conexão
    $conn=mysqli_connect($servidor, $usuario, $senha, $dbname) or die ("erro");

    
    $alvo = $nSorteio;
    $tbl_alvo_nome_com_underline = str_replace(" ", "_", $alvo);
    
    $sql = "SELECT * FROM tbl_sorteios WHERE nome_sorteio = '$alvo'";
    $result_query = mysqli_query($conn, $sql);
    $row_query = mysqli_fetch_assoc($result_query);
    $idSorteio = $row_query['id'];
    $quantr = $row_query['quant_rifas'];

    //salvando nome da tbl
    echo "<script>var tbl = '$tbl_alvo_nome_com_underline'</script>";

    //contagem dos valores das rifas pagos
    $sql2 = "SELECT COUNT(nome_compra_confirmada) FROM $tbl_alvo_nome_com_underline";
    $result_query_pagos = mysqli_query($conn, $sql2); 
    $row_query_pago = mysqli_fetch_assoc($result_query_pagos);
    $pagos = $row_query_pago['COUNT(nome_compra_confirmada)'];
     //ok

    //contagem dos valores das rifas reservadas
    $sql3 = "SELECT count(nome_reserva) FROM $tbl_alvo_nome_com_underline";
    $result_query_reservados = mysqli_query($conn, $sql3); 
    $row_query_reservado = mysqli_fetch_assoc($result_query_reservados);
    $qtd_reserva = $row_query_reservado['count(nome_reserva)'];
    $qtd_reserva = $qtd_reserva - $pagos;
    
    $disponiveis = 0;
    
    //contagem rifas disponiveis
    if($quantr == '1000'){
        $disponiveis = '1000'-($pagos + $qtd_reserva);
    }else{
        if($quantr == '100'){
            $disponiveis = 100-($pagos + $qtd_reserva);
        }
    }
    
    


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Imperador dos premios</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/carousel/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="{{ asset('css/carousel.css') }}" rel="stylesheet">
    <!link rel="stylesheet" href="../site/css/gallery-css-master/dist/gallery.theme.css">
    <!link rel="stylesheet" href="../site/css/gallery-css-master/dist/gallery.min.css">
    <link rel="stylesheet" href="{{ asset('css/pagina-do-sorteio.css') }}">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    
  </head>
  <body>
    <header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-*">
    <a class="navbar-brand" href="../../index.php"><img src="{{ asset('content/imperadorLogo.png') }}" alt="" width="200" height="auto"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="https://api.whatsapp.com/send?phone=5531995856178&text=Acabei%20de%20Reservar%20um%20número%20no%20Site">Enviar Comprovante</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="../../index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="./listar-sorteios-site.php">Sorteios</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="http://instagram.com/imperadordospremios"> <img src="../../assets/instagram-esbocado.png" alt="" width="19px" height="19ox"></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="https://api.whatsapp.com/send?phone=5531995856178&text=Minha%20de%20Dúvida%20é:"> <img src="../../assets/whatsapp.png" alt="" width="19px" height="19ox"></a>
        </li>
        
      </ul>
      
    </div>
  </nav>
</header>
<main role="main">
    <!-- Modal -->
    <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Título do modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                    ...
                </div>
                <div class="modal-footer" id="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button onclick="Reservar()" name="btn-submit" id="re-numero" type="button" class="btn btn-primary">Reservar numero</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal REGISTRADO RESERVA COM SUCESSO -->
        <div class="modal fade" id="modalReservado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalReservadoLabel">Título do modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body-r">
                    ...
                </div>
                <div class="modal-footer" id="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button name="btn-submit" id="re-numero-r" type="button" class="btn btn-primary">Reservar numero</button>
                </div>
                </div>
            </div>
        </div>

        
        <div class="conteudo">
            
        
            <div class="col1">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner">

                    <div id="carrosel-item-active" class="carousel-item active">
                        <img src="{{ asset('imagens/sorteios/'.$row_query['img1']) }}" alt="">
                    </div>

                    <div class="carousel-item">
                        <img class="img-fluid" src="{{ asset('imagens/sorteios/'.$row_query['img2']) }}">
                    </div>

                    <div class="carousel-item">
                        <img class="img-fluid" src="{{ asset('imagens/sorteios/'.$row_query['img3']) }}">
                    </div>

                    <div class="carousel-item">
                    <img class="img-fluid" src="{{ asset('imagens/sorteios/'.$row_query['img4']) }}">
                    </div>



                    </div>
                    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                    </a>
                </div>
    
                
            </div>

            <div class="col2">
                <label><?php echo($row_query['nome_sorteio']); ?></label><br>
                <hr id="hr-titulo">
                <div id="custo">
                    <label id="cpu">Valor : R$ <?php echo number_format($row_query['valor_por_unidade'],2,",",".") ?></label>

                </div>
                <textarea name="" id="txtarea" cols="30" rows="10" readonly><?php echo($row_query['descricao_sorteio']);?>
                </textarea>

            </div>

        </div>

        <div class="grid-numbers">

            
            
            <div class="grid">
                <button onclick="reloadFilteringTodos()" id="todos-btn">Todos</button>
                <button onclick="reloadFilteringDisp()" id="disponiveis">Disponíveis <?php echo($disponiveis) ?></button>
                <button onclick="reloadFilteringReservados()" id="reservado-btn">Reservados <?php echo($qtd_reserva) ?></button>
                <button onclick="reloadFilteringPagos()" id="pago-btn" >Pagos <?php echo($pagos) ?></button>
            </div>

            <div id="grid-all" class="grid">
                <?php

                    $sql = "SELECT * FROM $tbl_alvo_nome_com_underline WHERE id = '$idSorteio'";
                    $result_query = mysqli_query($conn, $sql);
                    while($row_query = mysqli_fetch_assoc($result_query)){ 
                        if($row_query['nome_reserva'] != null && $row_query['nome_compra_confirmada'] == null && $row_query['telefone'] != null){ ?>
                            <button title="<?php echo($row_query['nome_reserva']) ?>" class="bt-reserved" onclick="pesquisarNumero(id)" id="<?php echo($row_query['numero_rifa']); ?>" data-toggle="modal" data-target="#modalExemplo"><?php echo($row_query['numero_rifa']); ?></button>
                        
                        <?php }

                        if($row_query['nome_reserva'] != null && $row_query['nome_compra_confirmada'] != null && $row_query['telefone'] != null){ ?>
                            <button title="<?php echo($row_query['nome_reserva']) ?>" class="bt-buyed" onclick="pesquisarNumero(id)" id="<?php echo($row_query['numero_rifa']); ?>" data-toggle="modal" data-target="#modalExemplo"><?php echo($row_query['numero_rifa']); ?></button>
                        
                        <?php }

                        if($row_query['nome_reserva'] == null && $row_query['nome_compra_confirmada'] == null && $row_query['telefone'] == null){ ?>
                            <button title="<?php echo($row_query['nome_reserva']) ?>" class="bt-disponible" onclick="pesquisarNumero(id)" id="<?php echo($row_query['numero_rifa']); ?>" data-toggle="modal" data-target="#modalExemplo"><?php echo($row_query['numero_rifa']); ?></button>
                        
                        <?php }
                                            
                    }

                ?>
                

                
            </div>

            <div id="grid-reservados" class="grid">
                <?php

                    $sql = "SELECT * FROM $tbl_alvo_nome_com_underline WHERE id = '$idSorteio'";
                    $result_query = mysqli_query($conn, $sql);
                    while($row_query = mysqli_fetch_assoc($result_query)){ 
                        if($row_query['nome_reserva'] != null && $row_query['nome_compra_confirmada'] == null && $row_query['telefone'] != null){ ?>
                            <button title="<?php echo($row_query['nome_reserva']) ?>" class="bt-reserved" onclick="pesquisarNumero(id)" id="<?php echo($row_query['numero_rifa']); ?>" data-toggle="modal" data-target="#modalExemplo"><?php echo($row_query['numero_rifa']); ?></button>
                        
                        <?php }
                                            
                    }

                ?>
                

                
            </div>

            <div id="grid-disponiveis" class="grid">
                <?php

                    $sql = "SELECT * FROM $tbl_alvo_nome_com_underline WHERE id = '$idSorteio'";
                    $result_query = mysqli_query($conn, $sql);
                    while($row_query = mysqli_fetch_assoc($result_query)){

                        if($row_query['nome_reserva'] == null && $row_query['nome_compra_confirmada'] == null && $row_query['telefone'] == null){ ?>
                            <button title="<?php echo($row_query['nome_reserva']) ?>" class="bt-disponible" onclick="pesquisarNumero(id)" id="<?php echo($row_query['numero_rifa']); ?>" data-toggle="modal" data-target="#modalExemplo"><?php echo($row_query['numero_rifa']); ?></button>
                        
                        <?php }
                                            
                    }

                ?>
                

                
            </div>

            <div id="grid-pago" class="grid">
                <?php

                    if(isset($_GET['filtro'])){
                        echo("<script>alert('gay')</script>");
                    }
                    $sql = "SELECT * FROM $tbl_alvo_nome_com_underline WHERE id = '$idSorteio'";
                    $result_query = mysqli_query($conn, $sql);
                    while($row_query = mysqli_fetch_assoc($result_query)){ 
                        if($row_query['nome_reserva'] != null && $row_query['nome_compra_confirmada'] != null && $row_query['telefone'] != null){ ?>
                            <button title="<?php echo($row_query['nome_reserva']) ?>" class="bt-pago" onclick="pesquisarNumero(id)" id="<?php echo($row_query['numero_rifa']); ?>" data-toggle="modal" data-target="#modalExemplo"><?php echo($row_query['numero_rifa']); ?></button>
                        
                        <?php }
                                            
                    }

                ?>
                

                
            </div>

        </div>

        <div id="formas-text">
            <div>
            <a id="font-formas-pagamento">FORMAS DE PAGAMENTO</a>
            </div>
            <hr style="background-color: white; width: 100%; height: 1;">
            <div>
            <a id="font-formas-pagamento-desc">Escolha uma das contas abaixo para realizar o pagamento</a>
            </div>

        </div>

        <div class="container-fluid" id="container-fluid">
    
            <!-- Three columns of text below the carousel -->
            <div class="row" id="formas-pagamento">

            <div class="col-md-3" id="pagamento-1">
                <img src="../../assets/PIC.png" alt="" width="200" height="200">
                
                <p>PicPay ID<br>
                @kenedyfm<br>
                <a href="https://picpay.me/kenedyfm">Pagar com Picpay</a>
                </p>
                <p><!-- a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p> -->
            </div><!-- /.col-lg-4 -->
            <div class="col-md-3" id="pagamento-2">
                <img src="../../assets/INTER.png" alt="" width="200" height="200">
                
                <p>Banco Inter - 077
                Titular: Kenedy Florentino Mota
                CPF: 141.141.416-00
                Agência: 0001
                Conta: 6353787-7
                Tipo: Conta Corrente</p>
                <!-- <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p> -->
            </div><!-- /.col-lg-4 -->
            <div class="col-md-3" id="pagamento-3">
                <img src="../../assets/NUBANK.png" alt="" width="200" height="200">
                
                <p>NuConta - 260
                Titular: Kenedy Florentino Mota
                CPF: 141.141.416-00
                Agência: 0001
                Conta: 26345277-6
                Tipo: Conta Corrente</p>
                <!--<p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p> -->
            </div><!-- /.col-lg-4 -->
            <div class="col-md-3" id="pagamento-4">
                <img src="../../assets/PAG.png" alt="" width="200" height="200">
                
                <p>PagSeguro Internet S.A - 290
                Titular: Kenedy Florentino Mota
                CPF: 141.141.416-00
                Agência: 0001
                Conta: 10883908-5
                Tipo: Conta Corrente</p>
                <!-- <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p> -->
            </div><!-- /.col-lg-4 -->
            
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <br>

        <div class="row featurette">
        <div id="formas-text2">
            <div>
            <a id="font-instrucoes">INSTRUÇÕES</a>
            </div>
            <hr style="background-color: white; width: 100%; height: 1;">
            <div>
            <a style="font-size: 20px;color: white;">Ficou com dúvida? Siga os passos abaixo</a>
            </div>

        </div>

        <div id="img-passos">
            <!img width="100%" id="passos" src="./assets/passo-a-passo/PASSO-A-PASSO-PC.png" >
        </div>
        
            
        </div>


        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->



  


  
    
  </div><!-- /.container -->


  <!-- FOOTER -->
  <footer class="container">
    <a href="../../index.php">Home</a><br>
    <a href="../../termos.php">Termos</a><br>
    <a href="./listar-sorteios-site.php">Sorteios</a><br>
    <a href="http://instagram.com/imperadordospremios"> </a><a href="http://instagram.com/imperadordospremios"><img src="../../assets/instagram-esbocado.png" alt="" width="19px" height="19ox"></a><br>
    <a href="https://api.whatsapp.com/send?phone=5531995856178&text=Minha%20de%20Dúvida%20é:"> </a><a href="https://api.whatsapp.com/send?phone=5531995856178&text=Minha%20de%20Dúvida%20é:"><img src="../../assets/whatsapp.png" alt="" width="19px" height="19ox"></a>
    <br><br>
    <p>Todos os direitos reservados &copy; 2020 Imperador dos Prêmios&middot; </p>

 
  </footer>




</main>
<script>
        function detectar_mobile() {
          var check = false; //wrapper no check
          (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
          if(check == true){
              document.getElementById('img-passos').innerHTML = '<img width="100%" id="passos" src="../../assets/passo-a-passo/PASSO-A-PASSO-MOBILE.png" >';
          }else{
            document.getElementById('img-passos').innerHTML = '<img width="100%" id="passos" src="../../assets/passo-a-passo/PASSO-A-PASSO-PC.png" >';
          }
          return check;
        }
        detectar_mobile();
      </script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script>

        var uns = '';//ultimo numero selecionado
        


        document.getElementById('grid-all').style.display = 'inline';
        document.getElementById('grid-disponiveis').style.display = 'none';
        document.getElementById('grid-reservados').style.display = 'none';
        document.getElementById('grid-pago').style.display = 'none';

        function reloadFilteringTodos(){
            document.getElementById('grid-all').style.display = 'inline';
            document.getElementById('grid-disponiveis').style.display = 'none';
            document.getElementById('grid-reservados').style.display = 'none';
            document.getElementById('grid-pago').style.display = 'none';
        }

        function reloadFilteringDisp(){
            document.getElementById('grid-all').style.display = 'none';
            document.getElementById('grid-disponiveis').style.display = 'inline';
            document.getElementById('grid-reservados').style.display = 'none';
            document.getElementById('grid-pago').style.display = 'none';
        }

        function reloadFilteringReservados(){
            document.getElementById('grid-all').style.display = 'none';
            document.getElementById('grid-disponiveis').style.display = 'none';
            document.getElementById('grid-reservados').style.display = 'inline';
            document.getElementById('grid-pago').style.display = 'none';
        }

        function reloadFilteringPagos(){
            document.getElementById('grid-all').style.display = 'none';
            document.getElementById('grid-disponiveis').style.display = 'none';
            document.getElementById('grid-reservados').style.display = 'none';
            document.getElementById('grid-pago').style.display = 'inline';
        }


        pesquisarNumero = (idButtonPress) => {
            var id = idButtonPress;
            uns = id;
            
            
            var url = 'http://imperadordospremios.ga/sorteio/site/verifyNumber.php';
            
            fetch(url, {
                method : 'post',
                headers: {
                    'Content-Type': 'application/json',  // sent request
                    'Accept': 'application/json',   // expected data sent back
                },
                body: JSON.stringify({
                    idNumber: id,
                    tblSorteio: tbl,
                    })
            })
            .then((response) => response.json())
            .then((res) => {
                console.log(res.message)
                console.log(res.status)
                atualizarModal(id, res.message)
                

            })
            .catch((error) => console.log(error))
        

        }

        function atualizarModal(number, state){
            if(state == "sucess"){
                var space = "  Reservado com sucesso!";
                var newTitle = number.concat(space);

                document.getElementById('modalReservadoLabel').textContent = newTitle;
                var reservadoComSucesso = '<div>\
                                        <b>Voce acabou de reservar seu número para participar do sorteio,</b>\
                                        <b>clique no link para enviar o comprovante de transferencia para validar sua compra</b><br>\
                                        <a href="https://api.whatsapp.com/send?phone=5531995856178&text=Acabei%20de%20Reservar%20um%20número%20no%20Site">Enviar Comprovante</a>\
                                        </div>';
                
                document.getElementById('modal-body-r').innerHTML = reservadoComSucesso;
                document.getElementById('re-numero-r').style.display = 'none';

            }

            if(state == "Disponivel"){
                
                var contentDisponivel = '<div class="input-group mb-3">\
                                            <div class="input-group-prepend">\
                                                <span class="input-group-text" id="inputGroup-sizing-default">Nome</span>\
                                            </div>\
                                            <input id="UsrNome" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">\
                                        </div>\
                                        <div class="input-group mb-3">\
                                            <div class="input-group-prepend">\
                                                <span class="input-group-text" id="inputGroup-sizing-default">Telefone</span>\
                                            </div>\
                                            <input id="UsrTelefone" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">\
                                        </div>';


                document.getElementById('modal-body').innerHTML = contentDisponivel;
                document.getElementById('re-numero').style.display = 'inline';

            }else if(state == "Reservada"){
                document.getElementById('re-numero').style.display = 'none';
                document.getElementById('modal-body').innerHTML = "este número ja foi reservado, tente outro número";
            }
            var space = "  ";
            var newTitle = number.concat(space).concat(state);
            document.getElementById('exampleModalLabel').textContent = newTitle;

        }


        Reservar = () => {
            var numero = uns;
            var UsrNome = document.getElementById('UsrNome').value;
            var UsrTelefone = document.getElementById('UsrTelefone').value;
            
            var url = 'http://imperadordospremios.ga/sorteio/site/gravarReserva.php';
            
            fetch(url, {
                method : 'post',
                headers: {
                    'Content-Type': 'application/json',  // sent request
                    'Accept': 'application/json',   // expected data sent back
                },
                body: JSON.stringify({
                    idNumber: numero,
                    tblSorteio: tbl,
                    nome: UsrNome,
                    telefone: UsrTelefone,
                    })
            })
            .then((response) => response.json())
            .then((res) => {
                console.log(res.message)
                if(res.message == 'sucess'){
                    atualizarModal(numero, res.message)
                    $('#modalExemplo').modal('hide');

                        $("#modalReservado").modal({
                            show: true
                        });
                        
                }
                

            })
            //.catch((error) => console.log(error))
        

        }
        
    </script>


</html>
