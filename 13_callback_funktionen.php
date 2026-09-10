<?php
// ========================================================================
// CALLBACK-FUNKTIONEN (PHP)
// ========================================================================
// Genau wie in JavaScript (siehe .js-Datei): eine Funktion, die als
// Argument übergeben wird, damit eine ANDERE Funktion sie aufruft. In PHP
// nutzt man dafür anonyme Funktionen/Closures (siehe lexikalischer Scope in
// Programmiergrundlagen) oder Arrow-Functions (`fn`, seit PHP 7.4).

// ------------------------------------------------------------------
// Ein einfacher Callback
// ------------------------------------------------------------------
// Der Typ "callable" sagt PHP: "hier wird etwas Aufrufbares erwartet"
// (eine anonyme Funktion, eine Arrow-Function, oder auch der Name einer
// normalen Funktion als String).

function begruesse(string $name, callable $callback): void
{
    $callback("Hallo $name");
}

begruesse("Max", function ($msg) {
    echo $msg;
});
echo "<br>";

// Arrow-Function (fn) - Kurzform, die automatisch die Variablen der
// Umgebung "lexikalisch einfängt" (siehe Programmiergrundlagen), OHNE dass
// man dafür extra "use (...)" schreiben muss:
begruesse("Anna", fn($msg) => print(strtoupper($msg)));
echo "<br>";


// ------------------------------------------------------------------
// Callbacks in eingebauten Array-Funktionen - der Hauptanwendungsfall in PHP
// ------------------------------------------------------------------
$zahlen = [1, 2, 3, 4, 5];

// array_map: wendet den Callback auf JEDES Element an, gibt ein neues Array zurück
$verdoppelt = array_map(fn($n) => $n * 2, $zahlen);
print_r($verdoppelt); // [2, 4, 6, 8, 10]

// array_filter: behält nur die Elemente, für die der Callback true liefert
$gerade = array_filter($zahlen, fn($n) => $n % 2 === 0);
print_r($gerade); // [1 => 2, 3 => 4] - Achtung: Keys bleiben original erhalten!

// usort: sortiert ein Array mit einer EIGENEN Vergleichslogik statt der
// Standard-Sortierung von sort()
$namen = ["Charlie", "Alice", "Bob"];
usort($namen, fn($a, $b) => strcmp($a, $b)); // strcmp: alphabetischer String-Vergleich
print_r($namen); // [Alice, Bob, Charlie]

// Merksatz: Überall dort, wo PHP nicht von sich aus weiß, WIE genau etwas
// gefiltert/sortiert/verändert werden soll, übergibt man einen Callback, der
// diese Entscheidung für den konkreten Anwendungsfall trifft - die eingebaute
// Funktion (array_map/filter/usort) kümmert sich nur noch um den ABLAUF
// (jedes Element einmal durchgehen), nicht um die konkrete Logik.
