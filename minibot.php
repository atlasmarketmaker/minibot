<?php
require 'api.php';
        
use API\Client\API as API;

//IMPORTANTE!!! Criar uma conta nova na exchange, pois ela ira usar o seu saldo todo para isso!
///INICIOS DAS VARIAVEIS DE CONFIGURACAO
//Basicamento o funcionamento desse bot é bem simples, é comprar do BOOK comprador pelo menor preço, adicionar o valor das taxas e vender rapidamente por um preço um pouco maior.
//Basicamente esse BOT é para ser rodado 24 horas por dia, como não temos persistencia dos dados, vamos sempre supor que você ter o seu saldo em BTC disponivel!
$acumular = "BTC"; // Você pode configurar entre BTC ou BTCQ
$useMaxBTC = 0.02; // Quantidade de BTC que você quer usar no máximo
$API_KEY      = "338056082b787da543b124e"; //Sua KEY você poder gerar em https://quantum.atlasquantum.com/account (gerar chaves)
$API_SECRET   = "3380564824f0de73ba27aa97747add3ab"; //Sua API você poder gerar em https://quantum.atlasquantum.com/account (gerar chaves)
$fee = 0.5; //Recomendo fortemente negociar a fee com a Atlas, eles baixaram a minha!
$percentProfit = 0.1; //Total de lucro por operação em porcentagem, nesse cado 0.1%(cuidado, valores muito grandes vão demorar ou NÃO vão executar).


/////////FIM DAS VARIAVES




function logger($value)
{
	echo "[" . date("Y-m-d H:i:s")  . "] - " . $value . "\n";
}

logger("Iniciando bot...");

if(!$api = new API($API_KEY,$API_SECRET)){
	echo "erro de conexão"; return false;
}

logger("Balance de BTCQ");
//$response = $api->balance("BTCQ");
//var_dump($response);
//$oldBTCQ = $response->available;

logger("Balance de BTC");
//$response = $api->balance("BTC");
//var_dump($response);
//$oldBTC = $response->available;


while(true)
{
	
	logger("START BTC-BTCQ...");

	logger("Verificando minhas ordens...");
	$myOrders = $api->orders("BTC-BTCQ"); //Vamos capturar minhas ordens
	logger("Verificando order book...");
	$orderBook = $api->orderbook("BTC-BTCQ"); //Vamos capturar o book atual
	
	$isSell = false; //Variavel para verificar se tenho minha ordem de venda.	

	var_dump($myOrders->result);
	
	foreach ($myOrders->result as $my)
	{
    	if($my->status == "OPEN")    				
    		if($my->type == "SELL")    			
    				$isSell = true;
	}   
	

	if($isSell == false)	
	{
		logger("## Falta ordem de SELL"); //Nesse momento vamos comprar a mercado, e colocar uma ordem de venda
		$quantidade = 0;
		$last  = 0;		
		$lastRate  = 0;	
		$acumulado  = 0;	
		$depth = 0;
		foreach ($orderBook->result->Ask as $order) {    		
				$depth++;
				$acumulado += ($order->Rate * $order->Quantity);
				if($acumulado > $useMaxBTC)
				{
					if($last == 0)					
					{						
						$lastRate = $order->Rate;						
					}
					
    				
    				$total = round( $useMaxBTC / $lastRate,8);    		    	
    				logger("Criando uma ordem de compra a mercado!");
    				logger("## Depth " . $depth);
    				logger("## Quantidade " . $total);    				
    				logger("## Valor " . $lastRate);
    				
    				//BTCQ 1969.95658484
    				$response   = $api->newOrder("buy", "BTC-BTCQ", "LIMIT", $lastRate, $total);
    				var_dump($response);    				

    				$response = $api->balance("BTCQ");
					var_dump($response);
					$balance = $total;//$response->available;

					$valorSELL = round( ($lastRate) + (($lastRate*(($fee*2))+$percentProfit)/100),8);					
					
					
					logger("Criando uma ordem de venda a limit!");
					$response   = $api->newOrder("sell", "BTC-BTCQ", "LIMIT", $valorSELL, $balance);
    				var_dump($response);    									
    				logger("## Quantidade  " . $balance);    				
    				logger("## Valor " . $valorSELL);
    				    				
    				break;
    			}
    			else
    			{					
					$lastRate = $order->Rate;										
    			}
    			
		}	
	}

	logger("Aguardar 1s");
	sleep(1);
	
}



?>