<?php
use Mark\App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require 'vendor/autoload.php';

$api = new App('http://0.0.0.0:3000');

$api->count = 4; // process count

$api->any('/', function ($requst) {
    return 'Hello world';
});

$api->post('/generate-number', function ($requst) {
	try {
		$body = json_decode($requst->rawBody());
		
		$file = 'app.log';
		
		if (file_exists($file)) {
			$archivo = fopen ($file, "r");
			$num_lineas = 0;
				while (!feof ($archivo)) {
					if ($linea = fgets($archivo)){
					   $num_lineas++;
					}
				}
			fclose ($archivo);
			
			$correlativo= str_pad($num_lineas+1, 10, "0", STR_PAD_LEFT); 
		
		}else{
			$correlativo=str_pad(1, 10, "0", STR_PAD_LEFT); 
		}
		
		$logger = new Logger('correlationID: '.$correlativo);
		$logger->pushHandler(new StreamHandler(__DIR__.'/app.log', Logger::DEBUG));
		
		if($body->min==null || $body->max==null){
			
			$logger->warning('You must enter Min and Max Parameters');
			
			return json_encode(['code'=>400 ,'mensaje' => 'You must enter Min and Max Parameters']);
			
		}else if ($body->min > $body->max){
			
			$logger->warning('The minimum value cannot be greater than the maximum');
			
			return json_encode(['code'=>400 ,'mensaje' => 'The minimum value cannot be greater than the maximum']);
			
		}else{

			$number = random_int($body->min, $body->max);
			
			$logger->info('Ramdom Number generate: '.$number);
			
			return json_encode(['code'=>200 ,'Ramdom Number' => $number]);
		}
	
	 }catch(Exception $e){
		 $logger->error($e->getMessage());
		 
		 return json_encode(['code'=>500 ,'mensaje' => $e->getMessage()]);
	 }
});

$api->start();