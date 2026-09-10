<?php
// ========================================================================
// TYPSICHERHEIT: Type Hints & strict_types
// ========================================================================
// In Programmiergrundlagen hast du Type Juggling kennengelernt - PHPs
// automatische, manchmal überraschende Typumwandlung. Hier lernst du das
// Gegenmittel: PHP kann Funktionen dazu zwingen, sich an feste Typen zu
// halten, statt "irgendwas Passendes" zu akzeptieren.

// ------------------------------------------------------------------
// Type Hints - Datentypen bei Parametern und Rückgabewerten festlegen
// ------------------------------------------------------------------
function verdopple(int $zahl): int
{
    return $zahl * 2;
}
echo verdopple(5); // 10
echo "<br>";

// OHNE declare(strict_types=1) ist PHP im "koerziven" Modus: es versucht,
// den übergebenen Wert automatisch in den geforderten Typ umzuwandeln:
var_dump(verdopple("5")); // int(10) - "5" wird automatisch zu 5 gewandelt

// Das funktioniert aber nur, wenn der String WIRKLICH eine Zahl ist:
// verdopple("5 Äpfel"); // würde einen TypeError werfen - kein sauberer int


// ------------------------------------------------------------------
// declare(strict_types=1) - der Schalter für ECHTE Typsicherheit
// ------------------------------------------------------------------
// Fügt man diese Zeile GANZ OBEN in eine Datei ein (muss die erste
// Code-Zeile sein), verbietet PHP JEDE automatische Typumwandlung bei
// Funktionsaufrufen - der Typ muss exakt passen:
//
//   declare(strict_types=1);
//
//   function addiere(int $a, int $b): int {
//       return $a + $b;
//   }
//
//   addiere(2, 3);    // 5 - ok, beides sind echte Integer
//   addiere(2, "3");  // TypeError! Kein automatisches Casting mehr erlaubt,
//                     // obwohl "3" eine "saubere" Zahl wäre.
//
// (Aus technischen Gründen kann man strict_types nicht einfach so mitten in
// dieser Beispieldatei aktivieren, ohne den Rest der Datei zu beeinflussen -
// probier es am besten in einer eigenen kleinen Testdatei aus.)

// Merksatz: strict_types macht Fehler SOFORT sichtbar, statt sie durch
// stille Typumwandlung zu verstecken. In größeren, professionellen Projekten
// ist das fast immer die bessere Wahl.


// ------------------------------------------------------------------
// Union Types und Nullable Types (seit PHP 8)
// ------------------------------------------------------------------
// Manchmal soll ein Parameter MEHRERE Typen akzeptieren dürfen:

function formatiere(int|float $zahl): string
{
    return number_format($zahl, 2);
}
echo formatiere(5);    // 5.00
echo "<br>";
echo formatiere(5.5);  // 5.50
echo "<br>";

// Ein Fragezeichen vor dem Typ erlaubt zusätzlich null:
function zeigeName(?string $name): string
{
    return $name ?? "Unbekannt"; // siehe Null-Coalescing aus Programmiergrundlagen
}
echo zeigeName(null); // Unbekannt
echo "<br>";
echo zeigeName("Max"); // Max


// ------------------------------------------------------------------
// Ausblick: TypeScript - Typsicherheit für JavaScript
// ------------------------------------------------------------------
// JavaScript selbst hat GAR KEINE Typprüfung (siehe Type-Juggling-Problematik
// in Programmiergrundlagen, nur noch ausgeprägter). TypeScript ist eine
// Erweiterung von JavaScript, die genau das nachrüstet - allerdings nur
// beim ÜBERSETZEN (Compile-Zeit), nicht zur Laufzeit:
//
//   function verdopple(zahl: number): number {
//       return zahl * 2;
//   }
//
//   verdopple(5);     // ok
//   verdopple("5");   // Compile-Fehler! TypeScript meckert schon vorm Ausführen
//
// Der Unterschied zu PHPs strict_types: TypeScript prüft VOR der Ausführung
// (wie eine Compilersprache, siehe Basic-Syntax-Notiz), PHP prüft ERST beim
// tatsächlichen Aufruf zur Laufzeit. TypeScript-Code wird am Ende ohnehin zu
// normalem JavaScript "heruntergebaut" (transpiliert) - die Typen existieren
// nur während der Entwicklung, nicht mehr im ausgeführten Code.

// Merksatz: Typsicherheit heißt "Fehler so früh wie möglich entdecken" -
// PHP mit strict_types beim Aufruf, TypeScript schon beim Schreiben des Codes.
