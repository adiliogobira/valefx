<?php
namespace App\Service;

class Util{
    
    public function getData()
    {
        $mes["01"] = "Janeiro";
        $mes["02"] = "Fevereiro";
        $mes["03"] = "Março";
        $mes["04"] = "Abril";
        $mes["05"] = "Maio";
        $mes["06"] = "Junho";
        $mes["07"] = "Julho";
        $mes["08"] = "Agosto";
        $mes["09"] = "Setembro";
        $mes["10"] = "Outubro";
        $mes["11"] = "Novembro";
        $mes["12"] = "Dezembro";

        $diaSemana["0"] = "Domingo";
        $diaSemana["1"] = "Segunda-feira";
        $diaSemana["2"] = "Terça-feira";
        $diaSemana["3"] = "Quarta-feira";
        $diaSemana["4"] = "Quinta-feira";
        $diaSemana["5"] = "Sexta-feira";
        $diaSemana["6"] = "Sábado";

        $dia = date('d'); //Pega o dia
        $diasemana = date('w'); //Pega o dia da semana
        $mesn = date('m'); //Pega o mês
        $ano = date('Y'); //Pega o ano

        $string = $diaSemana["$diasemana"].', '.$dia.' de '.$mes["$mesn"].' de '.$ano;
        return $string;
    }
    
    public function converteMes($intMes)
    {
        ## converte um inteiro para string mes
        $mes["01"] = "Janeiro";
        $mes["02"] = "Fevereiro";
        $mes["03"] = "Março";
        $mes["04"] = "Abril";
        $mes["05"] = "Maio";
        $mes["06"] = "Junho";
        $mes["07"] = "Julho";
        $mes["08"] = "Agosto";
        $mes["09"] = "Setembro";
        $mes["10"] = "Outubro";
        $mes["11"] = "Novembro";
        $mes["12"] = "Dezembro";
        return $mes[$intMes];
    }
}