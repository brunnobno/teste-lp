<?php
require_once __DIR__ . '/SiteCloner.php';

header('Content-Type: application/json');

$url = $_GET['url'] ?? null;
if (!$url) {
    echo json_encode(["error" => "URL não informada."]);
    exit;
}

$result = SiteCloner::fetchHTML($url);

if (!empty($result['error'])) {
    echo json_encode(["error" => $result['error']]);
    exit;
}

$titulo = SiteCloner::extractTitle($result['html']);
$arquivo = SiteCloner::salvarComoArquivo($result['html']);

echo json_encode([
    "mensagem" => "Página clonada com sucesso.",
    "titulo" => $titulo,
    "arquivo" => $arquivo
]);