<?php
// ========================================================================
// CLOSURES VERTIEFT: eigener Zustand, Currying, Memoization
// ========================================================================
// In Programmiergrundlagen hast du `use` kennengelernt, um eine Variable
// lexikalisch in eine anonyme Funktion "einzufangen" (siehe Scope-Notiz).
// Hier drei mächtige Anwendungen davon, die in echten Projekten ständig
// vorkommen.

// ------------------------------------------------------------------
// Eigener, gekapselter Zustand pro Closure
// ------------------------------------------------------------------
// Jede Closure, die `erzeugeZaehler()` zurückgibt, bekommt ihre EIGENE
// Kopie von `$zaehler` - komplett unabhängig von allen anderen:

function erzeugeZaehler(): callable
{
    $zaehler = 0;
    return function () use (&$zaehler) { // & = per Referenz, damit ++ wirkt
        $zaehler++;
        return $zaehler;
    };
}

$counter1 = erzeugeZaehler();
$counter2 = erzeugeZaehler();
echo $counter1(); // 1
echo "<br>";
echo $counter1(); // 2 - counter1 zählt weiter
echo "<br>";
echo $counter2(); // 1 - counter2 hat SEINEN EIGENEN, unabhängigen Zähler!
echo "<br>";

// Merksatz: Das ist eine Alternative zu einer vollständigen Klasse (siehe
// OOP-Lektionen) für simple Fälle mit "privatem" Zustand - die Variable
// $zaehler ist von AUSSEN gar nicht erreichbar, nur über die Closure selbst.


// ------------------------------------------------------------------
// Currying - eine Funktion, die eine ANDERE Funktion zurückgibt
// ------------------------------------------------------------------
// Statt alle Parameter auf einmal zu übergeben, "konfiguriert" man die
// Funktion erst mit einem Teil der Argumente, bekommt eine neue,
// spezialisierte Funktion zurück:

function multipliziereMit(int $faktor): callable
{
    return fn($x) => $x * $faktor; // fängt $faktor lexikalisch ein
}

$verdopple = multipliziereMit(2);
$verdreifache = multipliziereMit(3);
echo $verdopple(5);     // 10
echo "<br>";
echo $verdreifache(5); // 15
echo "<br>";
// $verdopple und $verdreifache sind zwei komplett unterschiedliche
// Funktionen, obwohl beide aus DERSELBEN Vorlage erzeugt wurden.


// ------------------------------------------------------------------
// Memoization - Ergebnisse teurer Berechnungen zwischenspeichern
// ------------------------------------------------------------------
// Eine Closure kann sich einen "Cache" merken und bei WIEDERHOLTEM Aufruf
// mit denselben Argumenten das gespeicherte Ergebnis zurückgeben, statt
// erneut zu rechnen:

function memoize(callable $fn): callable
{
    $cache = [];
    return function (...$args) use ($fn, &$cache) {
        $schluessel = serialize($args); // Argumente als eindeutigen Key kodieren
        if (!isset($cache[$schluessel])) {
            echo "(berechne neu) ";
            $cache[$schluessel] = $fn(...$args); // ...$args = "spread", alle Argumente durchreichen
        }
        return $cache[$schluessel];
    };
}

$teureBerechnung = function ($n) {
    return $n * $n; // hier stünde in der Praxis etwas WIRKLICH Aufwändiges
};
$schnelleVersion = memoize($teureBerechnung);

echo $schnelleVersion(5); // (berechne neu) 25 - erster Aufruf, wird berechnet
echo "<br>";
echo $schnelleVersion(5); // 25 - zweiter Aufruf MIT GLEICHEN Argumenten: aus dem Cache!
echo "<br>";

// Merksatz: Currying und Memoization sind zwei der bekanntesten Muster, die
// zeigen, warum Funktionen als "First-Class-Citizens" (siehe Programmier-
// grundlagen) so mächtig sind - eine Funktion kann eine ANDERE Funktion
// erzeugen, konfigurieren oder mit Zwischenspeicher versehen.
