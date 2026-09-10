<?php
// ========================================================================
// OOP VERTIEFT: Datenkapselung, Polymorphie, OOA/OOD/OOP
// ========================================================================

// ------------------------------------------------------------------
// Datenkapselung (Encapsulation) - Zugriffsmodifizierer im Detail
// ------------------------------------------------------------------
// Du kennst schon "private" aus der letzten Lektion. Es gibt drei Stufen:
//
//   public    - von überall erreichbar (auch von außerhalb der Klasse)
//   protected - nur innerhalb der Klasse UND ihrer Unterklassen (siehe 05)
//   private   - NUR innerhalb genau dieser Klasse, auch Unterklassen nicht
//
// PHP 8 erlaubt außerdem "Constructor Property Promotion" - eine Kurzform,
// die Eigenschaft UND Konstruktor-Parameter in einer Zeile deklariert:

class Tier
{
    // Statt: private string $name; + $this->name = $name; im Konstruktor,
    // reicht diese eine Zeile:
    public function __construct(protected string $name)
    {
    }

    public function machGeraeusch(): string
    {
        return "..."; // Standard-Verhalten, wird von Unterklassen ÜBERSCHRIEBEN
    }
}

// Merksatz: Datenkapselung heißt, die INTERNEN Details eines Objekts vor der
// Außenwelt zu verstecken und nur einen kontrollierten Zugang (Methoden) nach
// außen anzubieten - wie eine Fernbedienung: du drückst Knöpfe (Methoden),
// musst aber nicht wissen, wie die Elektronik dahinter genau funktioniert.


// ------------------------------------------------------------------
// Polymorphie ("Vielgestaltigkeit")
// ------------------------------------------------------------------
// Polymorphie bedeutet: verschiedene Klassen können dieselbe Methode auf
// IHRE EIGENE Weise umsetzen - man ruft überall gleich `machGeraeusch()`
// auf, aber jedes Tier "antwortet" anders:

class Hund extends Tier
{
    public function machGeraeusch(): string
    {
        return "{$this->name} sagt: Wuff!";
    }
}

class Katze extends Tier
{
    public function machGeraeusch(): string
    {
        return "{$this->name} sagt: Miau!";
    }
}

$tiere = [new Hund("Rex"), new Katze("Mia")];
foreach ($tiere as $tier) {
    // Wir behandeln JEDES Element im Array gleich (als "Tier"), trotzdem
    // ruft PHP automatisch die RICHTIGE, überschriebene Methode auf:
    echo $tier->machGeraeusch();
    echo "<br>";
}
// Ausgabe: Rex sagt: Wuff!  /  Mia sagt: Miau!
// Das ist Polymorphie: derselbe Methodenaufruf, unterschiedliches Verhalten,
// abhängig vom TATSÄCHLICHEN Typ des Objekts.


// ------------------------------------------------------------------
// OOA, OOD, OOP - drei Phasen der objektorientierten Softwareentwicklung
// ------------------------------------------------------------------
// Diese drei Abkürzungen beschreiben nicht drei verschiedene Techniken,
// sondern drei aufeinanderfolgende PHASEN eines Projekts:
//
// OOA (Objektorientierte Analyse): WAS soll das System können? Welche
//   "Dinge" (Objekte) kommen in der Aufgabenstellung vor? Bei unserem
//   Tier-Beispiel: "Es gibt Tiere, die Geräusche machen."
//
// OOD (Objektorientiertes Design): WIE soll das System aufgebaut sein?
//   Welche Klassen, Eigenschaften, Methoden und Beziehungen zwischen ihnen
//   braucht man? Das ist die Phase, in der man z.B. ein UML-Klassendiagramm
//   zeichnet (siehe eigene UML-Notiz), BEVOR man Code schreibt.
//
// OOP (Objektorientierte Programmierung): Das eigentliche SCHREIBEN des
//   Codes, das die Ergebnisse aus OOA und OOD umsetzt - wie hier, mit
//   `class`, `extends`, etc.
//
// Merksatz: Erst verstehen (OOA), dann planen (OOD), dann bauen (OOP) -
// genau in dieser Reihenfolge, nicht andersrum. Je größer ein Projekt, desto
// teurer wird es, diese Reihenfolge zu überspringen.
