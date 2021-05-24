<a href="index.php">Voltar ao menu inicial</a>
<br><br>
<h1> Cadastro de novo cliente</h1>
<form method="post">
	Name : <input type="text" name="descricao" placeholder="Nome do cliente"><br><br>
  </select><br><br>
	<input type="submit" name="salvar" value="Salvar">
	<input type="reset" name="cancelar" value="Cancelar">
</form>

<?php
if(isset($_POST['salvar']))
{
include 'config.php';
  $descricao=$_POST['descricao'];
  $valor=str_replace(',','.', $_POST['valor']);
    
  $sql="INSERT INTO clientes (descricao) VALUES ('$descricao')";
  if($conn->query($sql) === false)
  { 
    trigger_error('Wrong SQL Command: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
  }  
  else 
  { 
    echo "<script>alert('Cliente cadastrado com sucesso!')</script>";
  	echo "<meta http-equiv=refresh content=\"0; url=clientes.php\">";
  }
}

?>   