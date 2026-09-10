# Mock-Up & Skizzen - die Benutzeroberfläche planen, bevor man sie baut

Konzeptionelles Thema (kein ausführbarer Code) - genauso wie UML/PAP (Lektion 07)
den ABLAUF vorher plant, planen Skizze/Wireframe/Mock-Up die OBERFLÄCHE vorher,
bevor eine Zeile HTML/CSS geschrieben wird.

## Die drei Stufen (steigende Detailtreue)

**1. Skizze (Sketch, "Low-Fi")**
Stift und Papier, wenige Minuten pro Entwurf. Zeigt nur die grobe Anordnung:
wo ist die Navigation, wo der Hauptinhalt, wo der Button. Bewusst hässlich und
schnell - der Punkt ist, in kurzer Zeit VIELE Varianten durchzuprobieren, ohne
Zeit in eine einzige zu investieren.

```
 ┌─────────────────────────┐
 │  LOGO      [Suche...]    │   <- Skizze: nur Kästchen und Beschriftung
 ├─────────────────────────┤
 │ [Bild]  Produktname       │
 │         12,99 €  [Kaufen] │
 ├─────────────────────────┤
 │ [Bild]  Produktname       │
 │         9,99 €   [Kaufen] │
 └─────────────────────────┘
```

**2. Wireframe**
Digital erstellt (z.B. Figma, Balsamiq), noch ohne Farben/Schriftart/Bilder -
nur Layout, Größen und Beschriftungen, dafür schon maßstäblich und für mehrere
Bildschirmgrößen (siehe Lektion 33: Responsive Design). Zweck: die STRUKTUR
und den Informationsfluss abstimmen, bevor Design-Details ablenken.

**3. Mock-Up ("Hi-Fi")**
Sieht aus wie die fertige Seite: echte Farben, Schriftart, Icons, Bilder -
aber meist noch nicht klickbar/funktional, nur ein Bild bzw. eine Figma-Datei.
Wird oft VOM Design-Team direkt mit Kunde/Product Owner abgestimmt, bevor
Entwickler überhaupt anfangen zu coden - Änderungen sind hier noch billig,
im fertigen Code sind sie teuer.

**Prototyp (Sonderfall Mock-Up)**
Ein klickbarer Mock-Up (z.B. in Figma verlinkte Screens) - fühlt sich an wie
eine echte App, ist aber kein echter Code. Gut, um Nutzer VOR der Entwicklung
testen zu lassen ("Usability-Test"), ohne dass ein Entwickler etwas gebaut hat.

## Warum das den Unterschied macht

Ein Layout-Fehler in einer Skizze kostet 30 Sekunden zum Korrigieren. Derselbe
Fehler, erst nach der fertigen Implementierung entdeckt, kostet unter Umständen
Tage (Code umschreiben, neue Tests, erneutes Review). Je früher in diesem
Prozess (Skizze → Wireframe → Mock-Up → Code) ein Problem auffällt, desto
billiger ist es zu beheben - derselbe Grundgedanke wie bei PAP/Struktogramm
und UML: erst planen, dann bauen.

## Mini-Übung

1. Skizziere (auf Papier oder in Worten) drei verschiedene Layout-Varianten
   für eine simple "Login"-Seite (E-Mail-Feld, Passwort-Feld, Button).
2. Warum würde man einen Kunden eher einen klickbaren Prototyp testen lassen
   als direkt die fertig programmierte Seite?

**Lösung Frage 2:** Weil ein Prototyp in Stunden statt Wochen entsteht - Fehler
im Grundkonzept (z.B. "Nutzer verstehen den Ablauf nicht") lassen sich so
finden und beheben, BEVOR überhaupt Entwicklungszeit investiert wurde.
