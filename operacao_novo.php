<a href="index.php">Voltar ao menu inicial</a>
<form method="post" >

<h1> Lançamento de nova operação</h1>
  
<html>
  <head>
	<title>Conversor de Moedas Completo</title>
    
    <style type='text/css'>	</style>
  </head>
  <body>
	<h1>Conversor de moedas</h1>
	<div>
		<label for='select_cliente'>Selecione o cliente: </label>
    <select type='select' name='select_cliente' id='select_cliente'>
    <option ></option>
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
      <option></option>
    <?php  
      $query = mysqli_query($conn,"select * from moedas");
      while($data= mysqli_fetch_assoc($query)){
       echo '<option value="'.$data["id"].'" data-valor="'.$data["valor"].'">'.$data["descricao"].'  </option>'  ;
       ?>
       <?php 
      }      
    ?>
    </select> 
  </div>
  <div>
    <label for='select_moeda_destino'>Selecione a moeda destino: </label>
    <select type='select' name='select_moeda_destino' id='select_moeda_destino'>
    <option></option>
    <?php  
      $query = mysqli_query($conn,"select * from moedas");
      while($data= mysqli_fetch_assoc($query)){
        echo '<option value="'.$data["id"].'" data-valor="'.$data["valor"].'">'.$data["descricao"].'  </option>'  ;
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
    <input type="button" onclick="calcula_conversao()" value="Calcular"/>
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
  
  $valor_original = str_replace(',','.', $_POST['edit_valor_original']);
  $valor_convertido=$_POST['edit_valor_calculado'];  
  $taxa_operacao= $_POST['taxa_operacao'];  
  $id_cliente=$_POST['select_cliente'];
  $id_moeda_origem=$_POST['select_moeda_origem'];
  $id_moeda_destino=$_POST['select_moeda_destino'];
  $data_operacao = date('d/m/y') ;
  
  error_reporting(E_ALL);

    $sql="INSERT INTO operacoes (id_cliente,id_moeda_origem, id_moeda_destino,data_operacao,valor_original,valor_convertido,taxa_operacao) VALUES ($id_cliente,$id_moeda_origem,$id_moeda_destino,'$data_operacao',$valor_original,$valor_convertido,$taxa_operacao)";

  if($conn->query($sql) === false)
  { 
    trigger_error('Wrong SQL Command: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
  }  
  else 
  { 
    echo "<script>alert('Operacção gravada com sucesso!')</script>";
    echo "<meta http-equiv=refresh content=\"0; url=index.php\">";
  } 
}
?>   


<script type="text/javascript">
      function imprimir()
      {
        console.log('foooi');
        
         window.open('rel1.php', '_blank');
      }

      function calcula_conversao() { 
        var taxa = 0.10;
        let valor_taxa = 0.00;
        let cliente = document.getElementById('select_cliente').value;
       
        var id_moeda_origem = document.getElementById('select_moeda_origem').value; 
        var moeda_origem = document.getElementById('select_moeda_origem');
        var valor_moeda_origem = document.querySelector("#select_moeda_origem option:checked").dataset.valor;
        valor_moeda_origem =  parseFloat(valor_moeda_origem.replace(',', '.'));

        var id_moeda_destino = document.getElementById('select_moeda_destino').value; 
        var moeda_destino = document.getElementById('select_moeda_destino');
        var valor_moeda_destino = document.querySelector("#select_moeda_destino option:checked").dataset.valor;
        valor_moeda_destino =  parseFloat(valor_moeda_destino.replace(',', '.'));

        let valor_base = document.getElementById('edit_valor_original').value;
        valor_base =  parseFloat(valor_base.replace(',', '.'));

        if (cliente > ''){
          if (valor_moeda_origem > 0){
            if (valor_moeda_destino > 0){
              if (valor_base > 0) {     
                valor_calculado = valor_moeda_destino / valor_moeda_origem * valor_base;
                valor_taxa = valor_calculado * taxa ;  
                valor_taxa = valor_taxa.toFixed(2);
                valor_calculado = valor_calculado.toFixed(2);

                document.getElementById('taxa_operacao').value = valor_taxa;
                document.getElementById('edit_valor_calculado').value = valor_calculado; //.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
              }else{
                window.alert('Necessário informar algum Valor');
              }
            }else{
              window.alert('Necessário informar moeda de destino');
            }
          }else{
            window.alert('Necessário informar moeda de origem');
          }
        }else{
          window.alert('Necessário informar o cliente');
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