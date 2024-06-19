<?php
// Încarcă fișierul XML
$xml = new DOMDocument;
$xml->load('users.xml');

// Încarcă foaia de stil XSL
$xsl = new DOMDocument;
$xsl->load('users.xsl');

// Creează un procesor XSLT
$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl);

// Transformă XML-ul în HTML folosind XSLT
echo $proc->transformToXML($xml);
?>
