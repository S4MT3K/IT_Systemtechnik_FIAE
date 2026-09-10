<?php
// ========================================================================
// FUNKTIONALE KONZEPTE: map/filter/reduce, Pure Functions, Immutability
// ========================================================================
// map und filter kennst du schon aus der Callback-Lektion. Hier kommt
// reduce dazu, plus zwei Ideen, die den "funktionalen" Programmierstil
// grundlegend prägen: Pure Functions und Immutability (Unveränderlichkeit).

// ------------------------------------------------------------------
// array_reduce - viele Werte zu EINEM Ergebnis zusammenfassen
// ------------------------------------------------------------------
// Während map() ein Array in ein GLEICH GROSSES neues Array verwandelt und
// filter() ein Array VERKLEINERT, fasst reduce() ALLE Werte zu einem
// EINZIGEN Ergebnis zusammen (eine Summe, ein Maximum, ein zusammengesetzter
// String, ...):

$zahlen = [1, 2, 3, 4, 5];

$summe = array_reduce(
    $zahlen,
    fn($akkumulator, $zahl) => $akkumulator + $zahl, // wird für jedes Element aufgerufen
    0 // Startwert des Akkumulators
);
echo $summe; // 15
echo "<br>";

// Ablauf im Kopf: 0+1=1, 1+2=3, 3+3=6, 6+4=10, 10+5=15
// $akkumulator "trägt" das Zwischenergebnis von einem Aufruf zum nächsten.


// ------------------------------------------------------------------
// Pure Functions - Funktionen ohne Überraschungen
// ------------------------------------------------------------------
// Eine PURE FUNCTION (reine Funktion) hat zwei Eigenschaften:
// 1. Bei GLEICHEN Eingaben kommt IMMER dasselbe Ergebnis raus.
// 2. Sie verändert NICHTS außerhalb von sich selbst (keine "Seiteneffekte"
//    wie das Verändern einer globalen Variable, siehe Scope-Notiz).

function addierePur(int $a, int $b): int
{
    return $a + $b; // hängt NUR von $a und $b ab, verändert sonst nichts
}
echo addierePur(2, 3); // 5
echo "<br>";
echo addierePur(2, 3); // immer 5, garantiert
echo "<br>";

// Zum Vergleich: eine UNPURE (unreine) Funktion mit Seiteneffekt
$aufrufZaehler = 0;
function addiereUnpur(int $a, int $b): int
{
    global $aufrufZaehler; // Seiteneffekt: verändert etwas AUSSERHALB der Funktion!
    $aufrufZaehler++;
    return $a + $b;
}
echo addiereUnpur(2, 3); // 5, gleiches Ergebnis wie oben
echo "<br>";
echo $aufrufZaehler; // 1 - aber das Programm hat sich HEIMLICH verändert!
echo "<br>";

// Merksatz: Pure Functions sind leichter zu TESTEN (siehe Unit-Testing-Notiz)
// und leichter zu VERSTEHEN, weil man beim Lesen keine versteckten
// Nebenwirkungen im Rest des Programms mitdenken muss.


// ------------------------------------------------------------------
// Immutability - das Original bleibt unangetastet
// ------------------------------------------------------------------
// Statt ein bestehendes Array/Objekt zu VERÄNDERN, erzeugt eine funktionale
// Herangehensweise lieber ein NEUES Array/Objekt mit dem gewünschten
// Ergebnis - das Original bleibt komplett unverändert:

$original = [1, 2, 3];
$neuesArray = array_map(fn($n) => $n * 2, $original); // erzeugt NEUES Array

print_r($original);   // [1, 2, 3] - komplett unverändert!
print_r($neuesArray);  // [2, 4, 6] - das eigentliche Ergebnis

// Merksatz: Immutability verhindert eine ganze Klasse von Bugs - wenn du
// weißt, dass sich $original NIE ändert, kannst du es an beliebig viele
// andere Funktionen weitergeben, ohne Angst haben zu müssen, dass eine davon
// es versehentlich verändert.
