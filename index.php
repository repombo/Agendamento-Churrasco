<?php 

  function limpar_texto($str){
        return preg_replace("/[^0-9]/", "", $str);
    }

  include("conexao.php");
  $erro = false;
  $deu_certo = false;

  if(count($_POST) > 0){

    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $data = $_POST['data'];
    $convidados = $_POST['convidados'];
    $servico = $_POST['servico'];
    $endereco = $_POST['endereco'];
    $mensagem = $_POST['mensagem'];

    if(empty($nome)){
      $erro = "Preencha o seu nome";
    }

    if(!empty($telefone)){
      $telefone = limpar_texto($telefone);
      if(strlen($telefone) != 11){
        $erro = "O telefone deve seguir o padrão (11) 98888-8888";
      }
    } else{
        $erro = "Preencha o seu telefone, para assim entrarmos em contato";
    }

    if(!empty($data)){
      $pedacos = explode('/', $data);
      if(count($pedacos) == 3){
        $data = implode('-', array_reverse($pedacos));
      }
    } else{
      $erro = "Preencha a data do evento";
    }

    if(empty($endereco)){
      $erro = "Preencha o bairro do evento";
    } 

    if(empty($convidados)){
      $erro = "Preencha a quantidade de convidados!";
    } 

    if($erro){
      echo "<p><b>Erro: $erro </b></p>";
    } else{
      $sql_code = "INSERT INTO pre_agendamento (data_evento, email, endereco, nome_cliente, nr_convidados, observacao, servico, telefone)
      VALUES ('$data', '$email', '$endereco', '$nome', '$convidados', '$mensagem', '$servico', '$telefone')";
      $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
      if($deu_certo){
        $de_certo = "<p><b>Sua data foi pré-agendada com sucesso! Aguarde que em breve entraremos em contato!</b></p>";
      }
    }

    
  }

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Brasa & Espeto — Agende seu churrasco</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Work+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
  <nav>
    <div class="logo">BRASA<span class="dot">&</span>ESPETO</div>
    <ul class="nav-links">
      <li><a href="#sobre">Sobre</a></li>
      <li><a href="#servicos">Serviços</a></li>
      <li><a href="#como-funciona">Como funciona</a></li>
      <li><a href="#agendar">Agendar</a></li>
    </ul>
    <a href="#agendar" class="nav-cta">Agendar agora</a>
  </nav>
</header>

<section class="hero">
  <div class="grain"></div>
  <div id="embers"></div>

  <div class="hero-grid">
    <div>
      <p class="eyebrow">Churrasco sob encomenda</p>
      <h1>Fogo na<br><em>brasa certa</em>,<br>sabor de verdade</h1>
      <p class="lede">Levo o churrasqueiro, os cortes selecionados e toda a estrutura até o seu evento. Você recebe os convidados — eu cuido da grelha.</p>
      <div class="hero-ctas">
        <a href="#agendar" class="btn-primary">Agendar meu churrasco</a>
        <a href="#servicos" class="btn-ghost">Ver serviços</a>
      </div>
      <div class="hero-stats">
        <div class="stat"><b>7+</b><span>anos de brasa</span></div>
        <div class="stat"><b>300+</b><span>eventos realizados</span></div>
        <div class="stat"><b>4.9</b><span>avaliação média</span></div>
      </div>
    </div>

    <div class="hero-visual">
      <svg class="skewer-svg" viewBox="0 0 300 400" preserveAspectRatio="xMidYMid slice">
        <defs>
          <linearGradient id="meatGrad" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0%" stop-color="#c96b3f"/>
            <stop offset="100%" stop-color="#7c3418"/>
          </linearGradient>
        </defs>
        <g stroke="#d9cbab" stroke-width="2" opacity="0.85">
          <line x1="70" y1="40" x2="70" y2="360"/>
          <line x1="150" y1="20" x2="150" y2="380"/>
          <line x1="230" y1="55" x2="230" y2="345"/>
        </g>
        <g>
          <rect x="52" y="70" width="36" height="34" rx="6" fill="url(#meatGrad)"/>
          <rect x="52" y="120" width="36" height="30" rx="6" fill="#3a2013"/>
          <rect x="52" y="166" width="36" height="34" rx="6" fill="url(#meatGrad)"/>
          <rect x="52" y="216" width="36" height="28" rx="6" fill="#3a2013"/>

          <rect x="132" y="55" width="36" height="34" rx="6" fill="#3a2013"/>
          <rect x="132" y="105" width="36" height="30" rx="6" fill="url(#meatGrad)"/>
          <rect x="132" y="151" width="36" height="34" rx="6" fill="#3a2013"/>
          <rect x="132" y="201" width="36" height="28" rx="6" fill="url(#meatGrad)"/>
          <rect x="132" y="245" width="36" height="30" rx="6" fill="#3a2013"/>

          <rect x="212" y="85" width="36" height="34" rx="6" fill="url(#meatGrad)"/>
          <rect x="212" y="135" width="36" height="30" rx="6" fill="#3a2013"/>
          <rect x="212" y="181" width="36" height="34" rx="6" fill="url(#meatGrad)"/>
        </g>
      </svg>
      <div class="hero-visual-label">Espeto corrido · picanha, alcatra & linguiça</div>
    </div>
  </div>
</section>

<section class="sobre" id="sobre">
  <div class="wrap sobre-grid">
    <div class="sobre-photo">
      <div class="ring r1"></div>
      <div class="ring r2"></div>
    </div>
    <div class="sobre-text">
      <p class="eyebrow">Quem prepara sua carne</p>
      <h2 style="margin-top:.6rem;">Sobre o churrasco</h2>
      <p>Sou churrasqueiro profissional e transformo qualquer evento — do aniversário íntimo à confraternização de empresa — numa experiência em volta da brasa. Cortes selecionados, ponto certo, tempero na medida.</p>
      <p>Trabalho com estrutura própria: churrasqueira, espetos, carvão, utensílios e, se precisar, mesa e cadeiras. Você define o número de convidados e o estilo do evento, eu cuido do resto — do fogo ao prato.</p>
      <div class="badges">
        <span class="badge">Cortes selecionados</span>
        <span class="badge">Estrutura completa</span>
        <span class="badge">Atendimento personalizado</span>
      </div>
    </div>
  </div>
</section>

<section id="servicos">
  <div class="wrap">
    <div class="section-head">
      <p class="eyebrow">O cardápio</p>
      <h2>Serviços</h2>
      <p>Cada pacote inclui churrasqueiro, preparo na hora e acompanhamento durante todo o evento. Ajusto quantidade de carne e acompanhamentos conforme o número de convidados.</p>
    </div>

    <div class="servicos-grid">
      <div class="card">
        <h3>Espeto Corrido</h3>
        <div class="preco">R$ 89<span> / convidado</span></div>
        <ul>
          <li>Picanha, alcatra e linguiça</li>
          <li>Pão de alho e vinagrete</li>
          <li>Churrasqueiro por 4 horas</li>
          <li>Ideal até 30 convidados</li>
        </ul>
      </div>

      <div class="card destaque">
        <span class="tag">Mais pedido</span>
        <h3>Churrasco Completo</h3>
        <div class="preco">R$ 129<span> / convidado</span></div>
        <ul>
          <li>6 cortes + frango e queijo coalho</li>
          <li>Acompanhamentos e farofa artesanal</li>
          <li>Churrasqueiro por 6 horas</li>
          <li>Estrutura de grelha inclusa</li>
        </ul>
      </div>

      <div class="card">
        <h3>Evento Corporativo</h3>
        <div class="preco">Sob consulta</div>
        <ul>
          <li>Cardápio personalizado</li>
          <li>Equipe de apoio e montagem</li>
          <li>Opções vegetarianas</li>
          <li>Ideal acima de 50 convidados</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="como" id="como-funciona">
  <div class="wrap">
    <div class="section-head">
      <p class="eyebrow">Do pedido à brasa</p>
      <h2>Como funciona</h2>
    </div>
    <div class="steps">
      <div class="step">
        <div class="n">01</div>
        <h3>Você agenda</h3>
        <p>Preenche a comanda com data, endereço e número de convidados.</p>
      </div>
      <div class="step">
        <div class="n">02</div>
        <h3>Confirmamos os detalhes</h3>
        <p>Entro em contato para fechar cardápio, horário e forma de pagamento.</p>
      </div>
      <div class="step">
        <div class="n">03</div>
        <h3>Levo a estrutura</h3>
        <p>Chego com antecedência para montar churrasqueira, carvão e utensílios.</p>
      </div>
      <div class="step">
        <div class="n">04</div>
        <h3>Churrasco na brasa</h3>
        <p>Preparo tudo na hora e sirvo os convidados durante todo o evento.</p>
      </div>
    </div>
  </div>
</section>

<section class="agendar" id="agendar">
  <div class="wrap agendar-grid">
    <div class="agendar-info">
      <p class="eyebrow">Sua comanda</p>
      <h2>Agende seu churrasco</h2>
      <p>Preencha os dados do seu evento. Confirmo a disponibilidade e retorno com os detalhes finais em até 24 horas.</p>

      <div class="contato-rapido">
        <a href="https://wa.me/5511999999999" target="_blank" rel="noopener">
          <span class="ico">↗</span> WhatsApp (11) 99999-9999
        </a>
        <a href="mailto:contato@brasaeespeto.com.br">
          <span class="ico">✉</span> contato@brasaeespeto.com.br
        </a>
        <a href="#">
          <span class="ico">📍</span> Atendo Grande São Paulo e região
        </a>
      </div>
    </div>

    <div class="comanda" id="comandaBox">
      <form id="agendaForm" action="" method="post">
        <div class="comanda-head">
          <h3>Comanda de agendamento</h3>
          <?php echo $deu_certo;?>
          <span>Nº provisório</span>
        </div>

        <div class="field">
          <label for="nome">Nome completo</label>
          <input type="text" id="nome" name="nome"  placeholder="Seu nome">
        </div>

        <div class="row2">
          <div class="field">
            <label for="telefone">Telefone / WhatsApp</label>
            <input type="tel" id="telefone" name="telefone"  placeholder="(11) 99999-9999">
          </div>
          <div class="field">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email"  placeholder="voce@email.com">
          </div>
        </div>

        <div class="row2">
          <div class="field">
            <label for="data">Data do evento</label>
            <input type="date" id="data" name="data" >
          </div>
          <div class="field">
            <label for="convidados">Nº de convidados</label>
            <input type="number" id="convidados" name="convidados" min="1" placeholder="Ex: 25">
          </div>
        </div>

        <div class="field">
          <label for="servico">Tipo de serviço</label>
          <select id="servico" name="servico">
            <option value="" disabled selected>Selecione um pacote</option>
            <option value="espeto-corrido">Espeto Corrido</option>
            <option value="churrasco-completo">Churrasco Completo</option>
            <option value="corporativo">Evento Corporativo</option>
            <option value="nao-sei">Ainda não sei / quero orientação</option>
          </select>
        </div>

        <div class="field">
          <label for="endereco">Endereço do evento</label>
          <input type="text" id="endereco" name="endereco" placeholder="Rua, número, cidade">
        </div>

        <div class="field">
          <label for="mensagem">Observações (opcional)</label>
          <textarea id="mensagem" name="mensagem" placeholder="Restrições alimentares, horário desejado, etc."></textarea>
        </div>

        <button type="submit" class="comanda-submit">Confirmar agendamento</button>
        <p class="comanda-note">Este é um pré-agendamento. Vou confirmar disponibilidade por telefone ou e-mail.</p>
      </form>

      <div class="comanda-success" id="comandaSuccess">
        <div class="stamp">Recebido!</div>
        <p>Comanda registrada para <strong id="successNome"></strong>.<br>
        Entro em contato em breve para confirmar o dia <span class="num" id="successData"></span>.</p>
      </div>
    </div>
  </div>
</section>

<footer>
  <div class="wrap footer-grid">
    <div class="logo">BRASA<span class="dot">&</span>ESPETO</div>
    <div class="footer-links">
      <a href="#sobre">Sobre</a>
      <a href="#servicos">Serviços</a>
      <a href="#agendar">Agendar</a>
    </div>
    <p class="fine">© 2026 Brasa & Espeto · Churrasco sob encomenda</p>
  </div>
</footer>

<script src="script.js"></script>

</body>
</html>
