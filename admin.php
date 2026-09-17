<?php 

include('conexao.php');

$sql_clientes = "select * from pre_agendamento";
$query_clientes = $mysqli->query($sql_clientes) or die($mysqli->error);
$num_clientes = $query_clientes->num_rows;
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Painel — Brasa & Espeto</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Work+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="textura-carvao"></div>

<div class="admin-shell">

  <aside class="sidebar">
    <div class="logo">BRASA<span class="dot">&</span>ESPETO</div>
    <div class="logo-sub">PAINEL · v1.0</div>

    <ul class="nav-admin">
      <li><a href="admin.php" class="ativa"><span class="marca"></span> Agendamentos</a></li>
      <li><a href="#"><span class="marca"></span> Serviços</a></li>
      <li><a href="#"><span class="marca"></span> Relatórios</a></li>
      <li><a href="#"><span class="marca"></span> Configurações</a></li>
    </ul>

    <div class="sidebar-footer">
      <!-- PHP: trocar pelo nome do administrador logado, ex. $_SESSION['admin_nome'] -->
      <div class="quem">Logado como <strong>Admin</strong></div>
      <a href="login.php" class="sair">Sair</a>
    </div>
  </aside>

  <main class="main">

    <div class="topbar">
      <h1>Agendamentos</h1>
      <div class="data-hoje"><?php echo date('d/m/Y'); ?></div>
    </div>

    <!-- PHP: os quatro números abaixo devem vir de consultas agregadas na tabela
         pre_agendamento, ex.: SELECT COUNT(*) ..., SELECT SUM(nr_convidados) ... -->
    <section class="stats-row">
      <div class="etiqueta cor-brasa">
        <span class="num"><?php echo $num_clientes?></span>
        <span class="rotulo">Agendamentos no mês</span>
      </div>
      <div class="etiqueta cor-ouro">
        <span class="num">05</span>
        <span class="rotulo">Aguardando confirmação</span>
      </div>
      <div class="etiqueta cor-verde">
        <span class="num">11</span>
        <span class="rotulo">Confirmados</span>
      </div>
      <div class="etiqueta cor-brasa">
        <span class="num">412</span>
        <span class="rotulo">Convidados no mês</span>
      </div>
    </section>

    <!-- PHP: form de busca via GET, ex. processar $_GET['busca'] no SELECT (nome_cliente LIKE ...) -->
    <div class="toolbar">
      <form class="busca-form" action="" method="get">
        <input type="text" name="busca" placeholder="Buscar por nome, telefone ou bairro">
        <button type="submit">Buscar</button>
      </form>

      <!-- PHP: cada link abaixo deve filtrar por status, ex. ?status=pendente,
           e a classe "ativo" deve ser aplicada conforme $_GET['status'] -->
      <nav class="filtros">
        <a href="?status=todos" class="ativo">Todos</a>
        <a href="?status=pendente">Pendentes</a>
        <a href="?status=confirmado">Confirmados</a>
        <a href="?status=cancelado">Cancelados</a>
      </nav>
    </div>

    <!-- Observação: a tabela pre_agendamento do banco ainda não tem uma coluna
         de status. Sugestão de migração antes de ligar o PHP:
         ALTER TABLE pre_agendamento
           ADD COLUMN status ENUM('pendente','confirmado','cancelado') NOT NULL DEFAULT 'pendente';
         Também assumi que existe uma coluna "id" (chave primária, auto_increment),
         usada nos formulários de ação abaixo. -->

    <section class="comandas-list">
      <table>
        <thead>
          <tr>
            <th>Cliente</th>
            <th>Contato</th>
            <th>Data do evento</th>
            <th>Convidados</th>
            <th>Serviço</th>
            <th>Endereço</th>
            <th>Observação</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>

        <tbody>
             <?php if($num_clientes == 0){ ?>
                <tr>
                    <td colspan="9">Nenhum cliente cadastrado</td>
                </tr>
              <?php } else{
                while($cliente = $query_clientes->fetch_assoc()){ ?>
              
        
          <tr>
            <td>
              <span class="principal"><?php echo $cliente['nome_cliente']?></span>
              <span class="secundario"><?php echo $cliente['email']?></span>
            </td>
            <td class="mono"><?php echo $cliente['telefone']?></td>
            <td class="mono"><?php echo $cliente['data_evento']?></td>
            <td class="mono"><?php echo $cliente['nr_convidados']?></td>
            <td><?php echo $cliente['servico']?></td>
            <td><?php echo $cliente['endereco']?></td>
            <td>
              <details class="obs">
                <summary>Ver Mais</summary>
                <p><?php echo $cliente['observacao']?></p>
              </details>
            </td>
            <td><span class="status status-pendente"><?php echo $cliente['status']?></span></td>
            <td class="acoes">
              <form class="acao-form" action="admin_editar.php" method="post">
                <input type="hidden" name="id" value="<?php echo $cliente['id'];?>">
                <button type="submit" name="acao" value="confirmar" class="confirmar">Confirmar</button>
              </form>
              <form class="acao-form" action="admin_excluir.php" method="post">
                <input type="hidden" name="id" value="<?php echo $cliente['id'];?>">
                <button type="submit" name="acao" value="cancelar" class="cancelar">Cancelar</button>
              </form>
              <form class="acao-form" action="" method="post" onsubmit="return false;">
                <input type="hidden" name="id" value="1">
                <button type="submit" name="acao" value="excluir" class="excluir">Excluir</button>
              </form>
            </td>
          </tr>

          <?php } 
          }?>
          
          

          <!-- PHP: caso a consulta não retorne nenhuma linha, mostrar em vez da
               tabela uma linha única com a mensagem abaixo -->
          <!--
          <tr>
            <td colspan="9" class="sem-resultado">Nenhum agendamento encontrado para este filtro.</td>
          </tr>
          -->
        </tbody>
      </table>
    </section>

    <!-- PHP: paginação real a partir do total de linhas / limite por página -->
    <nav class="paginacao">
      <a href="?pagina=1" class="atual">1</a>
      <a href="?pagina=2">2</a>
      <a href="?pagina=3">3</a>
    </nav>

  </main>
</div>

</body>
</html>
