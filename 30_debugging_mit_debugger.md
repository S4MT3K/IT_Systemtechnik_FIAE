# Echtes Debugging mit einem Debugger (Xdebug + PhpStorm)

*Kein Xdebug in dieser Kommandozeilen-Umgebung installiert - dieses Thema ist
IDE-Workflow, deswegen als Markdown-Anleitung statt als ausführbare Datei.*

## Einleitung

`var_dump()`/`die()` (Programmiergrundlagen) und Logging (eigene Notiz) zeigen dir
IMMER nur das, was du VORHER per Hand hingeschrieben hast, an genau der Stelle, an der
du es hingeschrieben hast. Ein echter Debugger geht einen Schritt weiter: er hält dein
Programm an einer beliebigen Stelle GENAU AN und lässt dich JEDE Variable im
aktuellen Zustand ansehen - ohne vorher auch nur eine einzige `var_dump()`-Zeile
geschrieben zu haben.

## Xdebug installieren (einmalig)

Xdebug ist eine PHP-Erweiterung, die PhpStorm (oder VS Code) mit deinem laufenden
PHP-Skript verbindet. Installation grob:

1. Xdebug-DLL/Extension passend zur eigenen PHP-Version herunterladen
   (`https://xdebug.org/wizard` hilft, die richtige Version zu finden)
2. In `php.ini` aktivieren: `zend_extension=xdebug`, `xdebug.mode=debug`
3. In PhpStorm: Einstellungen -> PHP -> Debug, Port meist `9003` (Standard seit
   Xdebug 3)

## Ein Breakpoint setzen

Ein Breakpoint markiert eine Zeile, an der das Programm AUTOMATISCH anhalten soll,
sobald die Ausführung dort ankommt - in PhpStorm einfach per Klick auf den roten
Punkt links neben der Zeilennummer:

```php
function berechnePreis(float $basispreis, float $rabatt): float
{
    $reduzierterPreis = $basispreis * (1 - $rabatt); // <- Breakpoint HIER setzen
    return $reduzierterPreis;
}
```

Startest du das Skript jetzt im Debug-Modus (statt normal auszuführen), PAUSIERT PHP
GENAU an dieser Zeile, bevor sie ausgeführt wird.

## Was man während einer Pause sehen und tun kann

- **Variablen-Fenster**: alle aktuell existierenden Variablen (`$basispreis`,
  `$rabatt`) UND ihre exakten Werte, live, ohne selbst `var_dump()` zu schreiben.
- **Step Over** (F8): die aktuelle Zeile ausführen, zur nächsten weitergehen.
- **Step Into** (F7): wenn die aktuelle Zeile eine Funktion aufruft, HINEIN in diese
  Funktion springen, statt sie einfach nur auszuführen.
- **Step Out** (Shift+F8): aus der aktuellen Funktion wieder HERAUS zur aufrufenden
  Stelle springen.
- **Watches**: einen eigenen Ausdruck (auch etwas Komplexeres wie
  `count($array) > 0`) beobachten, der bei jedem Stopp neu ausgewertet wird.
- **Call Stack**: die komplette Kette, WER diese Funktion bis hierher aufgerufen hat
  - extrem hilfreich bei tief verschachtelten Aufrufen (siehe Rekursion-Notiz).

## Bedingte Breakpoints

Ein Breakpoint muss nicht bei JEDEM Durchlauf anhalten - in einer Schleife mit 1000
Durchläufen will man oft nur beim 999. Durchlauf genau hinschauen:

```php
foreach ($bestellungen as $index => $bestellung) {
    $gesamtsumme += $bestellung->preis; // Rechtsklick auf den Breakpoint ->
                                          // Bedingung: $index === 998
}
```

## Grundprinzip

Ein Debugger ersetzt "rate, was der Wert an dieser Stelle sein könnte, und schreib
eine var_dump()-Zeile, um es herauszufinden" durch "schau dir den TATSÄCHLICHEN
Zustand an genau der Stelle an, ohne vorher irgendetwas im Code ändern zu müssen".
Das ist besonders bei Fehlern wertvoll, die man nicht auf Anhieb lokalisieren kann.

## Kurze Zusammenfassung

- Xdebug verbindet PHP mit der IDE für echtes Schritt-für-Schritt-Debugging.
- Ein Breakpoint hält die Ausführung an einer gewählten Zeile an.
- Step Over/Into/Out steuern, wie man sich durch den Code bewegt.
- Das Variablen-Fenster zeigt den LIVE-Zustand, ohne dass man `var_dump()`
  schreiben muss.
- Bedingte Breakpoints helfen bei Schleifen mit vielen Durchläufen.

## Mini-Übung

1. Was ist der Unterschied zwischen "Step Over" und "Step Into"?
2. Wozu ist ein bedingter Breakpoint gut?
3. Warum ist ein echter Debugger oft schneller als mehrere `var_dump()`-Zeilen?

**Lösung:**
1. "Step Over" führt die aktuelle Zeile aus und geht zur nächsten, OHNE in
   aufgerufene Funktionen hineinzuspringen. "Step Into" springt dagegen IN die
   aufgerufene Funktion hinein, um dort weiter zu debuggen.
2. Um in einer Schleife mit vielen Durchläufen nur bei einem BESTIMMTEN Durchlauf
   (z.B. wenn ein bestimmter Wert erreicht ist) tatsächlich anzuhalten, statt bei
   jedem einzelnen.
3. Weil man nicht vorher wissen muss, WELCHE Variable interessant sein wird - man
   sieht im Debugger einfach ALLE Variablen auf einmal, statt für jede einzelne
   erst eine eigene `var_dump()`-Zeile schreiben und den Code erneut ausführen zu
   müssen.
