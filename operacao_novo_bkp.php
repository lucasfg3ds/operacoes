<a href="index.php">Voltar ao menu inicial</a>
<form method="post" >

<h1> Lançamento de nova operação</h1>
  
<html>
  <head>
	<title>Conversor de Moedas Completo</title>
    <script type="text/javascript">
		  function calcula_conversao() { 
        var taxa = 0.10;
       
        var id_moeda_origem = document.getElementById('select_moeda_origem').value; 
        var moeda_origem = document.getElementById('select_moeda_origem');
        var valor = moeda_origem.getAttribute('vlr');
        var align = moeda_origem.dataset.vlr ;

        console.log(valor);
        console.log(align);

       
			  let cliente = document.getElementById('select_cliente').value;
			 // let moeda_um = document.getElementById('select_moeda_origem').value;

			  let moeda_dois =  document.getElementById('select_moeda_destino').value;
			  let valor_base = document.getElementById('edit_valor_original').value;


			  if (cliente > ''){
				  if (id_moeda_origem > 0){
				  	if (moeda_dois > 0){
			  			if (valor_base > 0) {
                valor_calculado = moeda_dois / valor_moeda_origem * valor_base;
                taxa = (valor_calculado * taxa).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                document.getElementById('taxa_operacao').value = taxa;
			  				document.getElementById('edit_valor_calculado').value = valor_calculado.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
			  			}else{
					  		window.alert('Necessário informar algum Valor')
				  		}
				  	}else{
					  	window.alert('Necessário informar moeda de destino')
				  	}
			  	}else{
			  		window.alert('Necessário informar moeda de origem')
			  	}
		  	}else{
		  		window.alert('Necessário informar o cliente')
	  		}
  		}										
	  	function limpar(){
	  		document.getElementById('edit_nome').value = '';
	  		document.getElementById('select_moeda_origem').value = '';
		  	document.getElementById('select_moeda_destino').value = '';
			  document.getElementById('edit_valor_original').value = '';
		  	document.getElementById('edit_valor_calculado').value = '';
		  }
	  </script>
    <style type='text/css'>	</style>
  </head>
  <body>
	<h1>Conversor de moedas</h1>
	<div>
		<label for='select_cliente'>Selecione o cliente: </label>
    <select type='select' name='select_cliente' id='select_cliente'>
    <option selected></option>
    <?php  
      include 'config.php';
      $query = mysqli_query($conn,"select * from clientes");
      while($data= mysqli_fetch_assoc($query)){
        echo '<option value="'.$data["id"].'">'.$data["descricao"].' </option>'  ;
        ?>
       <?php 
       }      
    ?>
    </select> 
 	</div>
	<div>
    <label for='select_moeda_origem'>Selecione a moeda origem: </label>
    <select type='select' name='select_moeda_origem' id='select_moeda_origem'>
    <option selected></option>
    <option value='1' data-vlr='11' >Teste</option>
    <?php  
      //$query = mysqli_query($conn,"select * from moedas");
      //while($data= mysqli_fetch_assoc($query)){
      //  echo '<option value="'.$data["id"].'" data-val="'.$data["valor"].'">'.$data["descricao"].'  </option>'  ;
      //  ?>
       <?php 
      // }      
    ?>
    </select> 
  </div>
  <div>
    <label for='select_moeda_destino'>Selecione a moeda destino: </label>
    <select type='select' name='select_moeda_destino' id='select_moeda_destino'>
    <option selected></option>
    <?php  
      $query = mysqli_query($conn,"select * from moedas");
      while($data= mysqli_fetch_assoc($query)){
        echo '<option value="'.$data["valor"].'">'.$data["descricao"].' </option>'  ;
        ?>
       <?php 
       }      
    ?>
    </select> 
  </div>
  <div>
  	<label for='edit_valor_original'>Informe o valor a ser convertido:  </label>
  	<input type='text' name='edit_valor_original' id='edit_valor_original'>
  </div>
   <div>
    <input type="button" name="calcular" onclick='calcula_conversao()' value="Calcular"/>
    <input type="button" name="limpar" onclick='limpar()' value="Limpar">
  </div>
  <div>
  	<label for='edit_valor_calculado'>Valor Calculado: </label>
  	<input type="Text" readonly name="edit_valor_calculado" id='edit_valor_calculado'/>
  </div>
  <div>
    <label for='taxa_operacao'>Taxa de operação 10: </label>
    <input type="Text" readonly name="taxa_operacao" id='taxa_operacao'/>
  </div>

  <br><br>
  <br><br>
  <input type="submit" name="salvar" value="Salvar"/>
  <input type="reset" name="cancelar" value="Cancelar"/>
  <br><br>
  <br><br>
  <br><br>
  <script type="text/javascript">document.write(Date());</script>
  </body>
</html>
</form>

<?php
if(isset($_POST['salvar']))
{

  $valor_original=str_replace(',','.', $_POST['edit_valor_original']);
  $valor_original=str_replace('R','', $valor_original);
  $valor_original=str_replace('$','', $valor_original);

  $valor_calculado=str_replace(',','.', $_POST['edit_valor_calculado']);  
  $valor_calculado=str_replace('R','', $valor_calculado);
  $valor_calculado=str_replace('$','', $valor_calculado);

  $id_cliente=$_POST['select_cliente'];
  $id_moeda_origem=$_POST['select_moeda_origem'];
  $id_moeda_destino=$_POST['select_moeda_destino'];
  $data_operacao = date('d/m/y') ;
  
  $taxa_operacao=str_replace(',','.', $_POST['taxa_operacao']);  
  $taxa_operacao=str_replace('R','', $taxa_operacao);
  $taxa_operacao=str_replace('$','', $taxa_operacao);

    $sql="INSERT INTO operacoes (id_cliente,id_moeda_origem, id_moeda_destino,data_operacao,valor_original,valor_calculado,taxa_operacao) VALUES ('$id_cliente,$id_moeda_origem,$id_moeda_destino,$data_operacao,$valor_original,$valor_calculado,$taxa_operacao')";

  if($conn->query($sql) === false)
  { 
    trigger_error('Wrong SQL Command: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
  }  
  else 
  { 
    echo "<script>alert('Operacção gravada com sucesso!')</script>";
    echo "<meta http-equiv=refresh content=\"0; url=imdex.php\">";
  }
}
?>   

