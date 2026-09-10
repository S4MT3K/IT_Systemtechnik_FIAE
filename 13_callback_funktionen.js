// ========================================================================
// CALLBACK-FUNKTIONEN
// ========================================================================
// Eine Callback-Funktion ist eine Funktion, die du als ARGUMENT an eine
// andere Funktion übergibst, damit diese sie zu einem SPÄTEREN Zeitpunkt
// aufruft ("call back" = "später zurückrufen"). Möglich, weil Funktionen in
// JS (und PHP, siehe Closures/lexikalischer Scope in Programmiergrundlagen)
// First-Class-Citizens sind - man kann sie wie ganz normale Werte behandeln.

// ------------------------------------------------------------------
// Ein einfacher Callback
// ------------------------------------------------------------------
function begruesse(name, callback) {
    const nachricht = `Hallo ${name}`;
    callback(nachricht); // die übergebene Funktion wird HIER aufgerufen
}

begruesse("Max", function (msg) {
    console.log(msg); // Hallo Max
});

// Kompakter mit einer Arrow-Function als Callback:
begruesse("Anna", (msg) => console.log(msg.toUpperCase())); // HALLO ANNA


// ------------------------------------------------------------------
// Callbacks für ZEITVERSETZTE Aktionen - setTimeout()
// ------------------------------------------------------------------
console.log("1: Start");
setTimeout(() => {
    console.log("3: Diese Zeile läuft SPÄTER (nach 0 Millisekunden 'Wartezeit')");
}, 0);
console.log("2: Diese Zeile läuft SOFORT");

// Überraschendes Ergebnis: die Reihenfolge ist 1, 2, 3 - NICHT 1, 3, 2!
// Der Grund: JavaScript ist SINGLE-THREADED (nur ein "Ausführungsstrang",
// siehe Nebenläufigkeits-Notiz) und arbeitet mit einem EVENT LOOP. Der
// Callback von setTimeout wird erst NACH dem kompletten aktuellen Code-Block
// ausgeführt, egal wie kurz die angegebene Wartezeit ist.


// ------------------------------------------------------------------
// Callbacks in eingebauten Array-Funktionen (siehe auch: funktionale Konzepte)
// ------------------------------------------------------------------
[1, 2, 3].forEach((zahl) => console.log("forEach:", zahl));

const verdoppelt = [1, 2, 3].map((zahl) => zahl * 2);
console.log(verdoppelt); // [2, 4, 6]

// Merksatz: Überall dort, wo eine Funktion NICHT sofort weiß, WANN oder WIE
// OFT etwas passieren soll (bei jedem Array-Element, nach einer Wartezeit,
// nach einer fertigen Netzwerk-Anfrage - siehe REST-API-Notiz), übergibt man
// ihr eine Callback-Funktion, die sie zum richtigen Zeitpunkt selbst aufruft.


// ------------------------------------------------------------------
// Vergleich zu PHP
// ------------------------------------------------------------------
// PHP kennt dasselbe Konzept über anonyme Funktionen/Closures (siehe
// lexikalischer Scope in Programmiergrundlagen) - das Grundprinzip ist
// identisch, nur ohne den Event-Loop-Aspekt, weil PHP klassischerweise
// synchron (Schritt für Schritt, ohne Zeitversatz) arbeitet:
//
//   function begruesse($name, callable $callback) {
//       $callback("Hallo $name");
//   }
//   begruesse("Max", function ($msg) { echo $msg; });
