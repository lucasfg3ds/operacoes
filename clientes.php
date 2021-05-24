
<h1> Clientes </h1>
<table border="">
 <tbody>
    <tr>
       <th>Codigo</th>
       <th>Descriçãp</th>
       <th>Ação</th>
    </tr>
    <?php
    include 'config.php';
    $a=mysqli_query($conn,"SELECT c.id, c.descricao from clientes c");
    foreach ($a as $b)
    {
     
    ?>
    <tr>
       <td><?= $b['id']; ?></td>
       <td><?= $b['descricao']; ?></td>
       <td>
            <a href="clientes_editar.php?id=<?= $b['id']; ?>"><b><i>Editar</i></b></a> | 
            <a href="clientes.php?id=<?= $b['id']; ?>" onclick="return confirm('Você tem certeza?')"><b><i>Apagar</i></b></a>
        </td>
    </tr>  
    
    <?php } ?>                          
 </tbody>
</table>

<br><br>        
<a href="clientes_novo.php">Cadastrar novo cliente</a>  

<?php

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $sql="DELETE FROM clientes WHERE id='$id'";
    if($conn->query($sql) === false)
    { 
      trigger_error('Wrong SQL Command: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
    } 
    else 
    { 
      echo "<script>alert('Cliente apagado com sucesso!')</script>";
      echo "<meta http-equiv=refresh content=\"0; url=clientes.php\">";
    }
}

?>