<?php
// ========================================================================
// BIG-O-NOTATION / ALGORITHMUSKOMPLEXITÄT
// ========================================================================
// Zwei Lösungen können bei kleinen Datenmengen GLEICH SCHNELL wirken - und
// bei großen Datenmengen komplett unterschiedlich performen. Big-O
// beschreibt, WIE die Laufzeit eines Algorithmus mit wachsender Datenmenge
// (meist "n" genannt) ansteigt - nicht wie schnell er in Sekunden ist.

// ------------------------------------------------------------------
// Die wichtigsten Big-O-Klassen (von schnell zu langsam)
// ------------------------------------------------------------------
// O(1)        - konstant: IMMER gleich schnell, egal wie groß n ist.
//               Beispiel: Zugriff auf ein Array-Element per Index ($arr[5]),
//               oder eine Hash Map per Key (siehe Datenstrukturen-Notiz).
//
// O(log n)    - logarithmisch: verdoppelt sich n, kommt nur EIN weiterer
//               Schritt dazu. Beispiel: binäre Suche (siehe Algorithmen-Notiz).
//
// O(n)        - linear: doppelt so viele Daten = doppelt so lange Laufzeit.
//               Beispiel: ein Array einmal komplett durchgehen (foreach).
//
// O(n log n)  - "linearithmisch": die meisten guten Sortieralgorithmen
//               (z.B. PHPs eingebautes sort()) liegen hier.
//
// O(n²)       - quadratisch: doppelt so viele Daten = VIERMAL so lange.
//               Beispiel: Bubble Sort (siehe Algorithmen-Notiz) - für JEDES
//               Element wird nochmal das GANZE restliche Array durchsucht.


// ------------------------------------------------------------------
// Der Unterschied in der PRAXIS - lineare vs. binäre Suche
// ------------------------------------------------------------------
$grossesArray = range(1, 1000000); // 1 Million Zahlen, aufsteigend sortiert

// Lineare Suche (O(n)) - PHPs in_array() schaut im schlimmsten Fall JEDES
// einzelne Element durch:
$start = microtime(true);
in_array(999999, $grossesArray);
$dauerLinear = microtime(true) - $start;

// Binäre Suche (O(log n)) - halbiert bei jedem Schritt das Suchgebiet:
function binaereSuche(array $arr, int $ziel): int
{
    $unten = 0;
    $oben = count($arr) - 1;
    $schritte = 0;
    while ($unten <= $oben) {
        $schritte++;
        $mitte = intdiv($unten + $oben, 2);
        if ($arr[$mitte] === $ziel) {
            return $schritte;
        }
        if ($arr[$mitte] < $ziel) {
            $unten = $mitte + 1;
        } else {
            $oben = $mitte - 1;
        }
    }
    return -1;
}
$start = microtime(true);
$schritte = binaereSuche($grossesArray, 999999);
$dauerBinaer = microtime(true) - $start;

echo "Lineare Suche: " . round($dauerLinear * 1000, 3) . " ms<br>";
echo "Binäre Suche: " . round($dauerBinaer * 1000, 3) . " ms, nur $schritte Schritte<br>";
// Typisches Ergebnis: binäre Suche ist um das 50-100-fache schneller, bei
// NUR ~20 Vergleichs-Schritten für 1 Million Elemente (statt bis zu 1 Million!)
// log2(1.000.000) ≈ 20 - genau das sagt "O(log n)" aus.


// ------------------------------------------------------------------
// Warum das wichtig ist
// ------------------------------------------------------------------
// Bei 100 Einträgen macht der Unterschied zwischen O(n) und O(n²) kaum
// spürbaren Unterschied. Bei 100.000 Einträgen kann aus "läuft in 0,01
// Sekunden" ein "läuft 100 Sekunden" werden - GENAU DERSELBE Algorithmus,
// nur mit mehr Daten. Das ist der Grund, warum Performance-Probleme oft erst
// in der Produktion auffallen, wenn "echte", große Datenmengen ankommen -
// beim Testen mit wenigen Beispieldaten fällt es schlicht nicht auf.

// Merksatz: Big-O beschreibt das WACHSTUMSVERHALTEN, nicht die absolute
// Geschwindigkeit. Ein O(n²)-Algorithmus kann bei kleinen Datenmengen sogar
// schneller sein als ein O(n log n)-Algorithmus - relevant wird der
// Unterschied erst, wenn n wirklich groß wird.
