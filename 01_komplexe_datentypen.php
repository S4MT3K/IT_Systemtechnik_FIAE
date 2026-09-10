<?php
// ========================================================================
// KOMPLEXE DATENTYPEN, NULL, INFINITY, NAN
// ========================================================================
// In Programmiergrundlagen kennst du schon int/float/string/bool/Arrays.
// Hier geht's um die "Randfälle": Werte, die "nichts" oder "keine gültige
// Zahl" bedeuten - und wie unterschiedlich Sprachen damit umgehen.

// ------------------------------------------------------------------
// NULL - "kein Wert", aber der Unterschied zu "nicht existent"
// ------------------------------------------------------------------
// PHP kennt NUR null, nicht "undefined" wie JavaScript (siehe .js-Datei).
// Eine nicht existierende Variable verhält sich in PHP ähnlich wie null,
// wirft aber zusätzlich eine Warning, weil sie nie deklariert wurde.

$wert = null;
var_dump($wert);        // NULL
var_dump($wert == null);  // true  - == vergleicht nur den Wert
var_dump($wert === null); // true  - === hier auch true, weil beide NULL sind
var_dump(is_null($wert)); // true  - explizite Prüf-Funktion


// ------------------------------------------------------------------
// INF und -INF - unendlich große/kleine Fließkommazahlen
// ------------------------------------------------------------------
// PHP hat eingebaute Konstanten dafür, genau wie viele andere Sprachen:

var_dump(INF);   // float(INF)
var_dump(-INF);  // float(-INF)

// ACHTUNG: Anders als in manchen anderen Sprachen (siehe JS!) führt eine
// Division durch 0 in PHP NICHT zu INF, sondern seit PHP 8 zu einem Fehler:
// var_dump(1 / 0.0); // würde einen DivisionByZeroError werfen!
// Um INF zu bekommen, muss man es entweder direkt verwenden oder z.B. eine
// Zahl nehmen, die größer als PHP_FLOAT_MAX ist:
var_dump(PHP_FLOAT_MAX * 2); // float(INF) - "übergelaufen" ins Unendliche


// ------------------------------------------------------------------
// NAN - "Not a Number", das Ergebnis undefinierter Rechenoperationen
// ------------------------------------------------------------------
var_dump(NAN); // float(NAN)

// NAN hat eine Besonderheit: es ist nie gleich sich selbst!
var_dump(NAN == NAN);  // false! Kontraintuitiv, aber Standard (IEEE 754)
var_dump(is_nan(NAN)); // true  - deswegen NIE mit == vergleichen, sondern is_nan()


// ------------------------------------------------------------------
// GARBAGE COLLECTOR - wer räumt den Speicher wieder auf?
// ------------------------------------------------------------------
// Jede Variable, jedes Objekt belegt Speicher. Irgendwann wird der nicht
// mehr gebraucht - z.B. wenn eine Funktion fertig ist und ihre lokalen
// Variablen (siehe Scope-Notiz) nicht mehr erreichbar sind.
//
// In "alten" Sprachen wie C/C++ musste man Speicher SELBST wieder freigeben
// (malloc/free) - vergisst man das, entsteht ein "Memory Leak" (der Speicher
// bleibt für immer belegt, obwohl ihn niemand mehr braucht).
//
// PHP (genau wie Java, C#, JavaScript, Python) hat einen automatischen
// GARBAGE COLLECTOR: er erkennt selbstständig, wenn ein Wert von NIRGENDWO
// mehr referenziert wird, und gibt den Speicher automatisch frei.

function erzeugeDaten() {
    $temp = str_repeat("x", 1000000); // 1 Million Zeichen, viel Speicher
    return "fertig";
    // Sobald die Funktion hier endet, ist $temp von nirgendwo mehr erreichbar.
    // Der Garbage Collector gibt den Speicher dafür automatisch frei -
    // wir mussten nichts manuell aufräumen.
}
echo erzeugeDaten();
echo "<br>";

// Merksatz: Automatische Speicherverwaltung ist einer der Hauptgründe, warum
// moderne Sprachen wie PHP/JS/Java "einfacher" sind als C/C++ - man kann sich
// auf die Logik konzentrieren, statt Speicher von Hand zu verwalten. Der
// Preis dafür: der Garbage Collector braucht selbst etwas Rechenzeit im
// Hintergrund, was C/C++ (ohne GC) potenziell schneller macht.
