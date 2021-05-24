
<h1> Moedas </h1>
<table border="">
 <tbody>
    <tr>
       <th>Codigo</th>
       <th>Descriçãp</th>
       <th>Valor</th>
       <th>Ação</th>
    </tr>
    <?php
    include 'config.php';
    $a=mysqli_query($conn,"SELECT m.id, m.descricao,m.valor from moedas m");
    foreach ($a as $b)
    {
     
    ?>
    <tr>
       <td><?= $b['id']; ?></td>
       <td><?= $b['descricao']; ?></td>
       <td><?= $b['valor']; ?></td>
       <td>
            <a href="moedas_editar.php?id=<?= $b['id']; ?>"><b><i>Editar</i></b></a> | 
            <a href="moedas.php?id=<?= $b['id']; ?>" onclick="return confirm('Você tem certeza?')"><b><i>Apagar</i></b></a>
        </td>
    </tr>  
    
    <?php } ?>                          
 </tbody>
</table>

<br><br>        
<a href="moedas_novo.php">Cadastrar nova moeda</a>  

<?php

if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $sql="DELETE FROM moedas WHERE id='$id'";
    if($conn->query($sql) === false)
    { 
      trigger_error('Wrong SQL Command: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
    } 
    else 
    { 
      echo "<script>alert('Moeda apagada com sucesso!')</script>";
      echo "<meta http-equiv=refresh content=\"0; url=moedas.php\">";
    }
}

?>