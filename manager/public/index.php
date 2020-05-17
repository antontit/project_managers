<?php

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

http_response_code(500);

(function () {

    $app = AppFactory::create();
	$app->addRoutingMiddleware();

	$isDebug = (bool)getenv('APP_DEBUG');
	$errorMiddleware = $app->addErrorMiddleware($isDebug, $isDebug, $isDebug);

	$app->get('/', function (Request $request, Response $response) {
		$payload = json_encode(['content' => 'hello world']);
		$response->getBody()->write($payload);
		return $response
          ->withHeader('Content-Type', 'application/json');
	});

	$app->run();
})();