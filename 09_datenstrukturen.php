<?php
// ========================================================================
// DATENSTRUKTUREN: Stack, Queue, Linked List, Hash Map
// ========================================================================
// Ein Array (Programmiergrundlagen) ist eine Datenstruktur - aber nicht die
// einzige. Andere Datenstrukturen regeln GEZIELT, WIE man Daten einfügt und
// wieder herausholt. Die Wahl der richtigen Struktur macht oft den
// Unterschied zwischen schnellem und langsamem Code (siehe Big-O-Notiz).

// ------------------------------------------------------------------
// Stack (Stapel) - LIFO: Last In, First Out
// ------------------------------------------------------------------
// Wie ein Stapel Teller: du legst oben drauf (push) und nimmst auch oben
// wieder weg (pop) - das ZULETZT hinzugefügte Element kommt zuerst wieder raus.

$stack = [];
array_push($stack, "Seite 1");
array_push($stack, "Seite 2");
array_push($stack, "Seite 3");
echo array_pop($stack); // "Seite 3" - zuletzt rein, zuerst raus
echo "<br>";

// PHP bringt dafür sogar eine fertige Klasse mit (SPL = Standard PHP Library):
$stack2 = new SplStack();
$stack2->push(1);
$stack2->push(2);
echo $stack2->pop(); // 2
echo "<br>";

// Typischer Einsatz: der "Zurück"-Button im Browser (jede besuchte Seite
// wird auf einen Stack gelegt), oder die Rückverfolgung bei Rekursion (Lektion 12).


// ------------------------------------------------------------------
// Queue (Warteschlange) - FIFO: First In, First Out
// ------------------------------------------------------------------
// Wie eine Warteschlange an der Kasse: wer ZUERST kommt, wird auch ZUERST
// bedient - komplett umgekehrt zum Stack.

$queue = [];
array_push($queue, "Kunde 1");
array_push($queue, "Kunde 2");
array_push($queue, "Kunde 3");
echo array_shift($queue); // "Kunde 1" - zuerst rein, zuerst raus
echo "<br>";

$queue2 = new SplQueue();
$queue2->enqueue("A");
$queue2->enqueue("B");
echo $queue2->dequeue(); // "A"
echo "<br>";

// Typischer Einsatz: Druckaufträge (wer zuerst druckt, wird zuerst gedruckt),
// Aufgaben-Warteschlangen in Hintergrundprozessen.


// ------------------------------------------------------------------
// Linked List (verkettete Liste) - Elemente, die aufeinander VERWEISEN
// ------------------------------------------------------------------
// Statt (wie ein Array) alle Elemente durchnummeriert hintereinander im
// Speicher zu halten, verweist hier jedes Element (Knoten) auf das NÄCHSTE:

class Knoten
{
    public function __construct(
        public mixed $wert,
        public ?Knoten $naechster = null
    ) {
    }
}

// Manuell verkettet: A -> B -> C
$dritterKnoten = new Knoten("C");
$zweiterKnoten = new Knoten("B", $dritterKnoten);
$ersterKnoten = new Knoten("A", $zweiterKnoten);

$aktuell = $ersterKnoten;
while ($aktuell !== null) {
    echo $aktuell->wert;
    $aktuell = $aktuell->naechster; // zum nächsten Knoten springen
}
echo "<br>";

// Vorteil gegenüber einem Array: Elemente MITTENDRIN einfügen/entfernen ist
// günstig (nur ein paar Verweise umbiegen), man muss nicht wie bei einem
// Array alle nachfolgenden Elemente "verschieben".
// Nachteil: man kann NICHT direkt "das 5. Element" anspringen (kein Index) -
// man muss sich von vorne durchhangeln.


// ------------------------------------------------------------------
// Hash Map - das kennst du schon: PHPs assoziative Arrays SIND Hash Maps!
// ------------------------------------------------------------------
// Eine Hash Map speichert Schlüssel-Wert-Paare und kann über den Schlüssel
// SEHR SCHNELL (nahezu unabhängig von der Größe) auf den passenden Wert
// zugreifen - dahinter steckt eine mathematische "Hash-Funktion", die aus
// dem Schlüssel direkt die Speicherposition berechnet, statt suchen zu müssen.

$hashMap = ["a" => 1, "b" => 2, "c" => 3];
echo $hashMap["b"]; // 2 - Zugriff ist blitzschnell, egal wie groß die Map ist
echo "<br>";

// Merksatz: Stack/Queue regeln die REIHENFOLGE, in der Daten rauskommen.
// Linked List regelt, WIE Elemente im Speicher verbunden sind. Hash Map
// regelt den SCHNELLEN Zugriff über einen Schlüssel. Jede Struktur ist für
// ein anderes Problem optimiert - "das eine richtige Array für alles" gibt
// es nicht.
