<?php
// ========================================================================
// ER-MODELL (ENTITY-RELATIONSHIP-MODELL) - DATEN VOR DEM CODE PLANEN
// ========================================================================
// Während das UML-Klassendiagramm (Lektion 07) OBJEKTE mit Verhalten (Methoden)
// plant, plant das ER-Modell reine DATEN und ihre Beziehungen - so wie sie
// später in Datenbank-Tabellen landen. Kein eigenes Datenbank-Modul hier,
// nur die Notation, weil sie in jedem Planungsprozess auftaucht.

// ------------------------------------------------------------------
// Die drei Grundbausteine
// ------------------------------------------------------------------
// ENTITÄT (Rechteck): ein "Ding", von dem es viele Exemplare gibt, z.B. Kunde
// ATTRIBUT (Ellipse): eine Eigenschaft einer Entität, z.B. Name, E-Mail
// SCHLÜSSELATTRIBUT (unterstrichene Ellipse): identifiziert ein Exemplar
//   eindeutig, z.B. Kunden-ID - entspricht später dem PRIMARY KEY der Tabelle
// BEZIEHUNG (Raute): verbindet zwei Entitäten, z.B. "bestellt"
//
//        ( Name )   ( E-Mail )
//             \        /
//         ┌─────────────────┐
//         │      Kunde       │
//         └────────┬────────┘
//                  │
//              ◇ bestellt ◇
//                  │
//         ┌────────┴────────┐
//         │    Bestellung    │
//         └─────────────────┘
//             /        \
//     (Bestell-ID)   (Datum)
//       (Schlüssel,
//        unterstrichen)


// ------------------------------------------------------------------
// Kardinalitäten - WIE VIELE hängen mit WIE VIELEN zusammen
// ------------------------------------------------------------------
// 1:1  - genau ein Exemplar der einen Seite gehört zu genau einem der anderen
//        Beispiel: Person <-> Personalausweis
// 1:n  - ein Exemplar der einen Seite gehört zu VIELEN der anderen
//        Beispiel: Kunde (1) <-> Bestellung (n) - ein Kunde hat viele
//        Bestellungen, aber jede Bestellung gehört zu genau einem Kunden
// n:m  - viele auf beiden Seiten
//        Beispiel: Bestellung (n) <-> Produkt (m) - eine Bestellung enthält
//        mehrere Produkte, und ein Produkt taucht in mehreren Bestellungen auf
//
//   Kunde  ──1───n──  Bestellung  ──n───m──  Produkt
//
// WICHTIG bei n:m: das lässt sich in einer relationalen Datenbank nicht
// direkt abbilden - dafür braucht man eine ZWISCHENTABELLE (hier z.B.
// "Bestellposition"), die aus der n:m-Beziehung zwei 1:n-Beziehungen macht.
// Das ist der Grund, warum man in fast jedem Bestellsystem eine Tabelle wie
// "Bestellposition" oder "Warenkorbeintrag" findet, die auf den ersten Blick
// unnötig wirkt.


// ------------------------------------------------------------------
// Vom ER-Modell zur Tabelle - der Übergang in echten Code
// ------------------------------------------------------------------
// Jede Entität wird eine Tabelle, jedes Attribut eine Spalte, das
// Schlüsselattribut der Primary Key. Eine 1:n-Beziehung wird durch einen
// FOREIGN KEY auf der "n"-Seite abgebildet - hier rein illustrativ als
// Arrays, ohne echte Datenbank:

$kunden = [
    1 => ["name" => "Anna Schmidt", "email" => "anna@example.com"],
];

$bestellungen = [
    // "kunde_id" ist der Fremdschlüssel - er zeigt auf den Primary Key
    // der Kunden-Tabelle und bildet damit die 1:n-Beziehung ab
    101 => ["datum" => "2026-09-01", "kunde_id" => 1],
];

$kundeName = $kunden[$bestellungen[101]["kunde_id"]]["name"];
echo "Bestellung 101 gehört zu: $kundeName" . PHP_EOL;


// ========================================================================
// MERKSATZ
// ========================================================================
// UML-Klassendiagramm: Objekte MIT Verhalten (Methoden) für den Code.
// ER-Modell: reine Daten UND ihre Beziehungen für die Datenbank.
// Beide werden oft VOR dem ersten Code-Zeile gezeichnet, nicht danach -
// deswegen "Planen" in Lektion 04 (OOA/OOD) und hier dieselbe Idee.
