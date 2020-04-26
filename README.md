# minibot
Mini bot para acumular BTC/BTCQ na exchange da atlas (https://quantum.atlasquantum.com)

Não me responsabilizo por perdas ou ganhos!

O funcionamento é bem simples! Ele compra do vendedor mais barato a preço de mercado, inclui as taxas necessárias e coloca para vender, normalmente ele dá bastante lucro, pois os robos da atlas estão comprando a todo momento ou em algumas horas do dia!

A configuração é bem SIMPLES, você deve apenas baixar o arquivo api.php e o minibot.php para a sua maquina, baixar o ultimo PHP, e instalar na sua maquina, após isso na pasta do php, no windows ou linux, digite

php minibot.php

Ele irá começar a rodar o robo, teoricamente estou evoluindo o código mais já tirei uma boa grana da ATLAS, muito mais do que estava preso, sempre saco de pouco em pouco para não levantar suspeitas lá dentro!

Bom espero que é isso! Vou colocando mais informações aqui!

Entre no nosso grupo do telegram para tirar dúvidas: https://t.me/robobtcq

Configuração:

//IMPORTANTE!!! Criar uma conta nova na exchange, pois ela ira usar o seu saldo todo para isso!
///INICIOS DAS VARIAVEIS DE CONFIGURACAO

//Basicamento o funcionamento desse bot é bem simples, é comprar do BOOK comprador pelo menor preço, adicionar o valor das taxas e vender rapidamente por um preço um pouco maior.

//Basicamente esse BOT é para ser rodado 24 horas por dia, como não temos persistencia dos dados, vamos sempre supor que você ter o seu saldo em BTC disponivel!

$acumular = "BTC"; // Você pode configurar entre BTC ou BTCQ

$useMaxBTC = 0.02; // Quantidade de BTC que você quer usar no máximo

$API_KEY      = "3380560825dc74ef4f185bccc2f705d7da543b124e"; //Sua KEY você poder gerar em https://quantum.atlasquantum.com/account (gerar chaves)

$API_SECRET   = "338056489fdf3c1c0bbb4b0b8824f0de73ba27aa97747add3ab"; //Sua API você poder gerar em https://quantum.atlasquantum.com/account (gerar chaves)

$fee = 0.5; //Recomendo fortemente negociar a fee com a Atlas, eles baixaram a minha!

$percentProfit = 0.1; //Total de lucro por operação em porcentagem, nesse cado 0.1%(cuidado, valores muito grandes vão demorar ou NÃO vão executar).


/////////FIM DAS VARIAVES
