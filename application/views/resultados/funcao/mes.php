<?php

function retornames($mes)
{

   if ($mes == '1')
      $mes = 'Janeiro';

   if ($mes == '2')
      $mes = 'Fevereiro';

   if ($mes == '3')
      $mes = 'Março';

   if ($mes == '4')
      $mes = 'Abril';

   if ($mes == '5')
      $mes = 'Maio';

   if ($mes == '6')
      $mes = 'Junho';

   if ($mes == '7')
      $mes = 'Julho';

   if ($mes == '8')
      $mes = 'Agosto';

   if ($mes == '9')
      $mes = 'Setembro';

   if ($mes == '10')
      $mes = 'Outubro';

   if ($mes == '11')
      $mes = 'Novembro';

   if ($mes == '12')
      $mes = 'Dezembro';



   return $mes;
}

function formata($valor)
{

   $valor = number_format($valor, 2, ",", ".");


   return $valor;
}

function porcento($valoratual, $valortotal)
{

   if ($valortotal == 0)
      $porcentagem = 0.0;
   else
      $porcentagem = ($valoratual / $valortotal) * 100;
      $porcentagem = number_format($porcentagem, 2, ",", ".");

   return $porcentagem;
}
