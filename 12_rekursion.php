<?php
// ========================================================================
// REKURSION
// ========================================================================
// Eine rekursive Funktion ist eine Funktion, die SICH SELBST aufruft, um
// ein Problem zu lösen, indem sie es in ein kleineres Teilproblem
// derselben Art zerlegt - bis das Teilproblem so klein ist, dass man es
// direkt beantworten kann.

// ------------------------------------------------------------------
// Fakultät - das klassische Einstiegsbeispiel
// ------------------------------------------------------------------
// 5! (sprich: "5 Fakultät") = 5 × 4 × 3 × 2 × 1 = 120
// Die Beobachtung: 5! = 5 × 4!, und 4! = 4 × 3!, usw. - jedes Problem lässt
// sich durch ein etwas KLEINERES, gleichartiges Problem lösen.

function fakultaet(int $n): int
{
    if ($n <= 1) {
        return 1; // BASISFALL / Abbruchbedingung - OHNE das: Endlosschleife!
    }
    return $n * fakultaet($n - 1); // rekursiver Aufruf mit kleinerem Problem
}

echo fakultaet(5); // 120
echo "<br>";

// Ablauf im Kopf durchgespielt:
// fakultaet(5) = 5 * fakultaet(4)
//              = 5 * (4 * fakultaet(3))
//              = 5 * (4 * (3 * fakultaet(2)))
//              = 5 * (4 * (3 * (2 * fakultaet(1))))
//              = 5 * (4 * (3 * (2 * 1)))          <- Basisfall erreicht, "Aufrollen" beginnt
//              = 120


// ------------------------------------------------------------------
// Jede Rekursion braucht ZWINGEND einen Basisfall
// ------------------------------------------------------------------
// Fehlt die Abbruchbedingung (oder wird sie nie erreicht), ruft sich die
// Funktion UNENDLICH oft selbst auf - das führt zu einem "Stack Overflow"
// (der Aufrufstapel, siehe Stack in der Datenstrukturen-Notiz, läuft über,
// weil jeder Aufruf sich Speicher "merkt", bis der wieder zurückkommt):

// function kaputt($n) {
//     return $n * kaputt($n - 1); // KEIN Basisfall - würde niemals aufhören!
// }


// ------------------------------------------------------------------
// Fibonacci - ein zweites klassisches Beispiel
// ------------------------------------------------------------------
// Jede Zahl ist die Summe der beiden vorherigen: 0, 1, 1, 2, 3, 5, 8, 13, ...

function fibonacci(int $n): int
{
    if ($n <= 1) {
        return $n; // Basisfall: die ersten beiden Zahlen sind einfach 0 und 1
    }
    return fibonacci($n - 1) + fibonacci($n - 2); // ZWEI rekursive Aufrufe!
}

echo fibonacci(10); // 55
echo "<br>";


// ------------------------------------------------------------------
// Rekursiv vs. iterativ - dasselbe Ergebnis, zwei Denkweisen
// ------------------------------------------------------------------
// Fast jede rekursive Lösung lässt sich auch mit einer Schleife (iterativ)
// schreiben:

function fakultaetIterativ(int $n): int
{
    $ergebnis = 1;
    for ($i = 2; $i <= $n; $i++) {
        $ergebnis *= $i;
    }
    return $ergebnis;
}
echo fakultaetIterativ(5); // 120, identisches Ergebnis
echo "<br>";

// Merksatz: Rekursion ist oft ELEGANTER/lesbarer für Probleme, die sich
// natürlich in gleichartige Teilprobleme zerlegen lassen (Bäume, Fibonacci,
// "Teile und herrsche"-Algorithmen wie z.B. die binäre Suche). Iterative
// Lösungen sind dagegen meist SPEICHEREFFIZIENTER, weil kein wachsender
// Aufrufstapel entsteht. In der Praxis: nimm, was lesbarer ist, außer die
// Rekursionstiefe wird zum echten Problem (sehr viele Ebenen).
