<a href="index.php">Voltar ao menu inicial</a>
<br><br>
<h1> Edição de moeda</h1>
<?php
include 'config.php';
$a=mysqli_query($conn,"SELECT * from moedas  WHERE id='$_GET[id]'");
$b=mysqli_fetch_array($a,MYSQLI_ASSOC)
?>
<form method="post">
	Codigo : <input type="text" name="id" placeholder="Codigo" value="<?= $b['id'] ?>"><br><br>
	Descricao : <input type="text" name="descricao" placeholder="Descricao" value="<?= $b['descricao']; ?>"><br><br>
	Valor : <input type="text" name="valor" placeholder="Valor" value="<?= $b['valor']; ?>"><br><br>
	<input type="submit" name="update" value="Alterar">
	<input type="reset" name="cancel" value="Cancelar">
</form>
<?php
if(isset($_POST['update']))
{
  include 'config.php';
  $id=$_POST['id'];
  $descricao=$_POST['descricao'];
  $valor=str_replace(',','.', $_POST['valor']);
  
  
  $sql="UPDATE moedas SET descricao ='$descricao',valor='$valor'  WHERE id='$_GET[id]'";
  if($conn->query($sql) === false)
  { 
    trigger_error('Wrong SQL Command: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
  }  
  else 
  { 
    echo "<script>alert('Alteração efetuada com sucesso!')</script>";
  	echo "<meta http-equiv=refresh content=\"0; url=moedas.php\">";
  }
}

?>   