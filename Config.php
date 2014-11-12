<?php

Class Config
{
    public function parametrosParaConexaoComMysql()
    {
        $config = [
            "host" => "localhost",
            "user" => "root",
            "password" => "",
            "dbname" => "pdo"];

        return $config;

    }
}