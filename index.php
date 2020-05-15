<?php
require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(url());

$router->namespace("Source\Controller");

/**
 * Veiculo
 * home
 */
$router->group(null);
$router->get("/", "Veiculo:home");
$router->get("/{q}/{modo}", "Veiculo:pesquisa");

/**
 * Veiculo
 * adicionar
 */
$router->group("adicionar");
$router->get("/", "Veiculo:formAdicionar");
$router->post("/", "Veiculo:adicionar");

/**
 * Veiculo
 * Excluir
 */
$router->group("excluir");
$router->delete("/{id}", "Veiculo:excluir");

/**
 * Veiculo
 * editar
 */
$router->group("editar");
$router->get("/{id}", "Veiculo:formEditar");
$router->post("/{id}", "Veiculo:editar");

/**
 * Veiculo
 * error
 */
$router->group("error");
$router->get("/{errcode}", "Veiculo:error");

$router->dispatch();

/**
 * Erro
 */
if ($router->error()) {
    $router->redirect("/error/{$router->error()}");
}