<?php
// ========================================================================
// ALGORITHMEN & DESIGN PATTERNS: Sortieralgorithmen, MVC, 3-Schichten-Architektur
// ========================================================================

// ------------------------------------------------------------------
// Bubble Sort - der einfachste (aber langsamste) Sortieralgorithmus
// ------------------------------------------------------------------
// Idee: vergleiche jeweils zwei benachbarte Elemente, tausche sie, wenn sie
// in falscher Reihenfolge stehen - wie Luftblasen, die nach oben "blubbern".
// Ein kompletter Durchlauf durch das Array bringt das GRÖSSTE Element ganz
// ans Ende, danach wiederholt man das für den Rest.

function bubbleSort(array $arr): array
{
    $n = count($arr);
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if ($arr[$j] > $arr[$j + 1]) {
                // Werte tauschen, ohne Zwischenvariable (List-Destrukturierung):
                [$arr[$j], $arr[$j + 1]] = [$arr[$j + 1], $arr[$j]];
            }
        }
    }
    return $arr;
}

print_r(bubbleSort([5, 2, 8, 1, 9, 3])); // [1, 2, 3, 5, 8, 9]

// Bubble Sort ist EINFACH zu verstehen, aber ineffizient (siehe Big-O-Notiz) -
// in echten Projekten benutzt man die eingebaute Funktion:
$array2 = [5, 2, 8, 1];
sort($array2); // sortiert intern mit einem viel schnelleren Algorithmus
print_r($array2);


// ------------------------------------------------------------------
// Binäre Suche - schnell suchen in einem SORTIERTEN Array
// ------------------------------------------------------------------
// Statt Element für Element durchzugehen, teilt man das Suchgebiet bei
// jedem Schritt HALBIERT - wie beim Zahlenraten "höher/niedriger":

function binaereSuche(array $sortiertesArray, int $ziel): int
{
    $unten = 0;
    $oben = count($sortiertesArray) - 1;

    while ($unten <= $oben) {
        $mitte = intdiv($unten + $oben, 2);
        if ($sortiertesArray[$mitte] === $ziel) {
            return $mitte; // gefunden!
        }
        if ($sortiertesArray[$mitte] < $ziel) {
            $unten = $mitte + 1; // Ziel muss in der oberen Hälfte sein
        } else {
            $oben = $mitte - 1;  // Ziel muss in der unteren Hälfte sein
        }
    }
    return -1; // nicht gefunden
}

$sortiert = [1, 2, 3, 5, 8, 9];
echo binaereSuche($sortiert, 8);   // 4 (Index von 8)
echo "<br>";
echo binaereSuche($sortiert, 100); // -1 (nicht enthalten)
echo "<br>";

// Merksatz: Binäre Suche braucht ein SORTIERTES Array, ist dafür aber extrem
// schnell - bei einer Million Elementen reichen etwa 20 Vergleiche, statt im
// schlimmsten Fall eine Million (siehe Big-O-Notiz für den genauen Vergleich).


// ------------------------------------------------------------------
// Entwurfsmuster (Design Patterns) - bewährte Lösungen für wiederkehrende Probleme
// ------------------------------------------------------------------
// Ein Entwurfsmuster ist KEIN fertiger Code zum Copy-Pasten, sondern eine
// bewährte STRUKTUR-IDEE für ein häufiges Problem. Zwei besonders wichtige:


// --- MVC (Model-View-Controller) ---
// Trennt eine Anwendung in drei Verantwortlichkeiten (vgl. Single
// Responsibility aus der Clean-Code-Lektion):
//
//   Model:      die Daten und Geschäftslogik (z.B. "was ist ein Konto")
//   View:       die Darstellung/Ausgabe (z.B. HTML, das der Nutzer sieht)
//   Controller: nimmt Nutzereingaben entgegen, steuert Model und View
//
// Nutzer-Klick -> Controller -> fragt Model -> gibt Daten an View -> Ausgabe

class KontoModel
{
    public function __construct(private float $stand)
    {
    }
    public function getStand(): float
    {
        return $this->stand;
    }
}

class KontoView
{
    public function render(KontoModel $model): string
    {
        // number_format($wert, Nachkommastellen, Dezimaltrenner, Tausendertrenner)
        return "Kontostand: " . number_format($model->getStand(), 2, ',', '.') . " €";
    }
}

class KontoController
{
    public function __construct(private KontoModel $model, private KontoView $view)
    {
    }
    public function zeigeKontostand(): string
    {
        return $this->view->render($this->model); // Controller verbindet Model+View
    }
}

$controller = new KontoController(new KontoModel(150.5), new KontoView());
echo $controller->zeigeKontostand(); // Kontostand: 150,50 €
echo "<br>";


// --- Drei-Schichten-Architektur ---
// Ein verwandtes, aber gröberes Konzept auf Projekt-Ebene:
//
//   Präsentationsschicht:  UI/API-Ausgabe (vergleichbar mit "View")
//   Logikschicht:          Geschäftsregeln, Berechnungen (vergleichbar "Model")
//   Datenschicht:          Datenbankzugriff, Dateizugriff
//
// MVC ist oft die konkrete Umsetzung der Präsentations- und Logikschicht
// INNERHALB einer Anwendung, die Drei-Schichten-Architektur beschreibt eher
// die GROBE Aufteilung eines ganzen Systems.

// Merksatz: Design Patterns lösen NICHT jedes Problem - sie sind Vokabular,
// mit dem Entwickler:innen sich schnell über eine bekannte Struktur
// verständigen können ("das machen wir nach MVC"), statt jedes Mal die
// komplette Architektur neu zu erklären.
