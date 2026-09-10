<?php
// ========================================================================
// REGULÄRE AUSDRÜCKE (RegEx)
// ========================================================================
// Ein regulärer Ausdruck ist eine kompakte "Mustersprache", um Text zu
// durchsuchen, zu prüfen oder zu ersetzen - viel mächtiger als
// str_replace()/strpos() (siehe Programmiergrundlagen), weil man MUSTER
// statt exakter Texte beschreibt ("eine Ziffer, gefolgt von einem
// Bindestrich" statt "genau DIESE eine Telefonnummer").

// ------------------------------------------------------------------
// Ein Muster gegen einen String prüfen - preg_match()
// ------------------------------------------------------------------
// PHP-Muster werden zwischen zwei gleichen Trennzeichen geschrieben
// (meist "/.../" ), mit Spezialzeichen für Muster-Bausteine:
//
//   \w   ein "Wortzeichen" (Buchstabe, Ziffer, Unterstrich)
//   \d   eine Ziffer
//   +    "ein oder mehrmals" (das Vorherige)
//   *    "null- oder mehrmals"
//   {2,} "mindestens 2-mal"
//   ^ $  Anfang / Ende des Strings
//   [...] "eine der aufgeführten Möglichkeiten"

$emailMuster = '/^[\w.+-]+@[\w-]+\.[a-zA-Z]{2,}$/';

var_dump(preg_match($emailMuster, "max.mustermann@example.com")); // int(1) = Treffer
var_dump(preg_match($emailMuster, "keine-email"));                 // int(0) = kein Treffer


// ------------------------------------------------------------------
// Den TREFFER selbst herausbekommen - preg_match() mit drittem Parameter
// ------------------------------------------------------------------
$text = "Meine Nummer ist 0176-1234567, ruf an!";
preg_match('/\d{3,5}-\d{6,7}/', $text, $treffer);
print_r($treffer);
// [0 => "0176-1234567"] - der gefundene Text landet in $treffer[0]


// ------------------------------------------------------------------
// Text ERSETZEN mit Muster - preg_replace()
// ------------------------------------------------------------------
// Praktisch, um z.B. alle HTML-Tags aus einem Text zu entfernen:

$html = "Hallo <b>Welt</b>, wie <i>geht</i> es dir?";
$ohneTags = preg_replace('/<[^>]+>/', '', $html);
// Muster: "<", dann beliebig viele Zeichen AUSSER ">" ([^>]+), dann ">"
echo $ohneTags; // Hallo Welt, wie geht es dir?
echo "<br>";


// ------------------------------------------------------------------
// Text ANHAND eines Musters AUFTEILEN - preg_split()
// ------------------------------------------------------------------
$csvZeile = "eins,zwei,,drei";
$teile = preg_split('/,/', $csvZeile);
print_r($teile); // ["eins", "zwei", "", "drei"] - beachte den leeren dritten Eintrag!

// Merksatz: RegEx ist mächtig, aber auch schnell UNLESBAR - für "einfache"
// Aufgaben (ein fester Text suchen) reichen str_replace()/strpos() völlig.
// RegEx lohnt sich, sobald ein MUSTER gemeint ist, nicht ein fester Text -
// Telefonnummern, E-Mail-Formate, "alle HTML-Tags", etc.
