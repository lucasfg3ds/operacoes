<a href="clientes.php">Clientes</a>
<a href="moedas.php">Moedas</a>


<br><br>
<table border="">
 <tbody>
    <tr>
       <th>Cliente</th>
       <th>Moeda original</th>
       <th>Moeda destino</th>
       <th>Data da operação</th>
       <th>Valor original</th>
       <th>Valor convertido</th>
       <th>Taxa cobrada</th>
    </tr>
    <?php
    include 'config.php';
    $a=mysqli_query($conn,"SELECT c.descricao descricao_cliente, m.descricao descricao_moeda_origem, m2.descricao descricao_moeda_destino, o.data_operacao , o.valor_original, o.valor_convertido, o.taxa_operacao
    FROM operacoes o, clientes c, moedas m, moedas m2
    WHERE  c.id  = o.id_cliente
      AND  m.id  = o.id_moeda_origem
      AND  m2.id = o.id_moeda_destino");
    foreach ($a as $b)
    {
     
    ?>
    <tr>
       <td><?= $b['descricao_cliente']; ?></td>
       <td><?= $b['descricao_moeda_origem']; ?></td>
       <td><?= $b['descricao_moeda_destino']; ?></td>
       <td><?= $b['data_operacao']  ; ?></td>
       <td><?= $b['valor_original']; ?></td>
       <td><?= $b['valor_convertido']; ?></td>
       <td><?= $b['taxa_operacao']; ?></td>
    </tr>  
    <?php } ?>                          
 </tbody>
</table>
<a href="operacao_novo.php">Efetuar nova operação</a>

