// ========================================================================
// REGULÄRE AUSDRÜCKE (RegEx) - JavaScript
// ========================================================================
// Gleiches Konzept wie in PHP (siehe .php-Datei), aber JS schreibt Muster
// OHNE Anführungszeichen, dafür zwischen Schrägstrichen als eigenen
// Datentyp (RegExp-Literal):

const emailMuster = /^[\w.+-]+@[\w-]+\.[a-zA-Z]{2,}$/;

console.log(emailMuster.test("max@example.com")); // true
console.log(emailMuster.test("keine-email"));      // false


// ------------------------------------------------------------------
// Den Treffer selbst bekommen - match()
// ------------------------------------------------------------------
const text = "Meine Nummer ist 0176-1234567";
const treffer = text.match(/\d{3,5}-\d{6,7}/);
console.log(treffer[0]); // 0176-1234567


// ------------------------------------------------------------------
// Ersetzen - replace() mit dem "g"-Flag (global = ALLE Treffer, nicht nur den ersten)
// ------------------------------------------------------------------
const ersetzt = "Hallo <b>Welt</b>, wie <i>geht</i> es?".replace(/<[^>]+>/g, "");
console.log(ersetzt); // Hallo Welt, wie geht es?

// Merksatz: Ohne das "g"-Flag würde replace() nur den ERSTEN Treffer
// ersetzen - ein häufiger Anfängerfehler, wenn man mehrere Vorkommen
// erwartet, aber keine "g"-Flag gesetzt hat.
