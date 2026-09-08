<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Entrar — Painel Brasa & Espeto</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Work+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="textura-carvao"></div>

<div class="login-shell">
  <div class="login-card">
    <div class="login-logo">BRASA<span class="dot">&</span>ESPETO</div>
    <h1>Painel administrativo</h1>
    <p class="hint">Entre com suas credenciais para ver e gerenciar os agendamentos recebidos pelo site.</p>

    <!-- PHP: exibir aqui a mensagem de erro vinda do processamento do login,
         ex.: <?php if($erro_login){ echo '<div class="login-erro">'.$erro_login.'</div>'; } ?> -->
    <!--
    <div class="login-erro">Usuário ou senha inválidos.</div>
    -->

    <form action="" method="post">
      <div class="campo">
        <label for="usuario">Usuário</label>
        <input type="text" id="usuario" name="usuario" autocomplete="username" placeholder="admin">
      </div>
      <div class="campo">
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" autocomplete="current-password" placeholder="••••••••">
      </div>
      <button type="submit" class="btn-entrar">Entrar</button>
    </form>
  </div>
</div>

</body>
</html>
