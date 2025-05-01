<?php

class SiteCloner {
    public static function fetchHTML($url) {
        $html = @file_get_contents($url);
        if (!$html) {
            return ["error" => "Falha ao acessar a URL informada."];
        }
        return ["html" => $html];
    }

    public static function extractTitle($html) {
        if (preg_match('/<title>(.*?)<\/title>/i', $html, $matches)) {
            return $matches[1];
        }
        return "Página Clonada";
    }

    public static function salvarComoArquivo($html, $nomeArquivo = "clonado.html") {
        $path = __DIR__ . "/../../estrutura-devbot/temporario/";
        if (!is_dir($path)) mkdir($path, 0755, true);
        file_put_contents($path . $nomeArquivo, $html);
        return $nomeArquivo;
    }
} 
