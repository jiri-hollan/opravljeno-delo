<?php
/**
*V prvem bloku pobere iz uporabnikiTbl vse zapise v katerih je vnesena številka zdravnika
*in prikaže ime, priimek, številka zdravnika, upstatus in gdpr.
*s klikom na določenega zdravnika se odpre menu, kje se lahko: 
*1.Izbere število ur v določenem dnevu ali v dnevih od do. 
*2.Lahko se pogleda, kaj vse je bilo v določenem dnevu (dnevih) vpisano.
*3.Lahko se pogleda po šifri oravila trajanje le tega po dnedih ali v odstotku
*
*
*
**/
/*/////////////////////////////////////////////
SELECT OrderID, SUM(Quantity) AS [Total Quantity]
FROM OrderDetails
WHERE ProductID <=12
AND ProductID >=11
GROUP BY OrderID;
*//////////////////////////////////////////////*/
/**
variable:

public $tabulka = deloTbl;
public $zacDatum;
public $koncDatum;
public $stevilkaZdravnika;
public SqlCasDela = '

SELECT datumOpravila, SUM(cas=pravila) AS [Po dnevih]
FROM $tabulka
WHERE stevilkaZdravnika = $stevilkaZdravnika
AND true
GROUP BY datumOpravila;

';

SELECT datumOpravila, SUM(casOpravila) AS [Po dnevih]
FROM $tabulka
WHERE stevilkaZdravnika = $stevilkaZdravnika
AND datumOpravila >= $zacDatum
AND datumOpravila >= $koncDatum
GROUP BY datumOpravila;

';

**/

?>