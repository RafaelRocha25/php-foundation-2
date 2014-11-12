<?php

Class Config
{
    public function parametrosParaConexaoComMysql()
    {
        $config = [
            "host" => "localhost",
            "user" => "user",
            "password" => "asus.pass",
            "dbname" => "pdo"];

        return $config;

    }
}