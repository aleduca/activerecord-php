<?php


function formatExcetion(Throwable $throw)
{
    var_dump("Erro no arquivo<b> {$throw->getFile()}</b> na linha <b>{$throw->getLine()}</b> com a mensagem <b><i>{$throw->getMessage()}</i></b>");
}
