// partículas de brasa subindo no hero
  const emberContainer = document.getElementById('embers');
  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if(!prefersReduced){
    for(let i=0;i<18;i++){
      const p = document.createElement('div');
      p.className = 'ember-particle';
      p.style.left = Math.random()*100 + '%';
      p.style.animationDelay = (Math.random()*7) + 's';
      p.style.animationDuration = (5 + Math.random()*4) + 's';
      emberContainer.appendChild(p);
    }
  }

  /*
  // formulário de agendamento (sem backend — mostra confirmação estilo carimbo)
  const form = document.getElementById('agendaForm');
  const success = document.getElementById('comandaSuccess');
  const comandaBox = document.getElementById('comandaBox');

  form.addEventListener('submit', function(e){
    e.preventDefault();
    const nome = document.getElementById('nome').value.trim() || 'convidado';
    const dataVal = document.getElementById('data').value;
    let dataFormatada = dataVal;
    if(dataVal){
      const [ano, mes, dia] = dataVal.split('-');
      dataFormatada = `${dia}/${mes}/${ano}`;
    }
    document.getElementById('successNome').textContent = nome;
    document.getElementById('successData').textContent = dataFormatada;

    comandaBox.classList.add('hide-form');
    success.classList.add('show');
  });
*/