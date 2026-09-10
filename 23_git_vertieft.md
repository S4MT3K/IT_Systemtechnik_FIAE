# Git vertieft: Branching, Merge-Konflikte, PR-Workflow

*Alle Befehle unten wurden in einem echten Test-Repo durchgespielt (inkl. eines
tatsächlichen Merge-Konflikts) - keine Behauptungen, sondern nachvollzogen.*

## Einleitung

In Programmiergrundlagen war Git bewusst nur Randnotiz. Hier ist es Kernkompetenz:
in echten Projekten arbeitest du NIE allein an EINER Version des Codes - Branching und
das saubere Auflösen von Konflikten sind der Alltag professioneller Teamarbeit.

## Branches - warum man NIE direkt auf main arbeitet

Ein Branch ist ein eigener, unabhängiger Entwicklungsstrang. In Teams gilt fast immer:
`main` (bzw. `master`) bleibt IMMER funktionsfähig, neue Features entstehen auf einem
eigenen Branch, der erst nach Prüfung zurückgeführt wird.

```bash
git checkout -b feature-login   # neuen Branch erstellen UND direkt wechseln
# ... Code ändern ...
git commit -am "Login-Feature hinzugefügt"
```

## Verzweigte Historie - zwei Branches ändern dieselbe Datei

```bash
git checkout main
# ... eine ANDERE Änderung an derselben Datei vornehmen ...
git commit -am "Andere Änderung auf main"
```

Jetzt existieren zwei Versionen derselben Datei - eine auf `feature-login`, eine auf
`main` - beide mit Änderungen an derselben Stelle.

## Der Merge-Konflikt - wenn Git nicht automatisch entscheiden kann

```bash
git merge feature-login
```

```
Auto-merging datei.txt
CONFLICT (content): Merge conflict in datei.txt
Automatic merge failed; fix conflicts and then commit the result.
```

Git öffnet dann die betroffene Datei mit speziellen Markierungen:

```
Zeile 1
<<<<<<< HEAD
Andere Änderung auf main
=======
Login-Feature
>>>>>>> feature-login
```

**So liest man das:** Alles zwischen `<<<<<<< HEAD` und `=======` ist DEIN aktueller
Stand (`main`). Alles zwischen `=======` und `>>>>>>> feature-login` kommt aus dem
Branch, den du gerade einmergen wolltest. Git kann nicht selbst entscheiden, welche
Version "richtig" ist - das musst DU von Hand klären.

## Konflikt auflösen

Die Konfliktmarkierungen von Hand entfernen und die gewünschte Endversion
hineinschreiben (hier: beide Änderungen behalten):

```
Zeile 1
Andere Änderung auf main
Login-Feature
```

```bash
git add datei.txt
git commit -m "Merge feature-login: Konflikt gelöst"
```

Das Ergebnis sieht man an der verzweigten und wieder zusammengeführten Historie:

```
*   2d8de16 Merge feature-login: Konflikt gelöst
|\
| * e7051a7 Login-Feature hinzugefügt
* | 45f51ef Andere Änderung auf main
|/
* 04532d4 Initial commit
```

## Pull-Request-Workflow (auf GitHub & Co.)

In der Praxis läuft die Zusammenführung meist NICHT per lokalem `git merge`, sondern
über die Plattform (GitHub, GitLab):

1. `git push -u origin feature-login` - eigenen Branch auf den Server hochladen
2. Auf GitHub einen **Pull Request** (PR) erstellen: "bitte `feature-login` in `main`
   übernehmen"
3. Teamkolleg:innen machen einen **Code-Review** - lesen den Diff, kommentieren,
   fordern ggf. Änderungen
4. Erst nach Freigabe wird der PR **gemerged** - oft automatisiert über die
   Weboberfläche, nicht per Hand

## Grundprinzip

Branches trennen parallele Arbeit, ohne dass sie sich gegenseitig stört. Merge-
Konflikte sind kein Fehler, sondern der ERWARTBARE Fall, wenn zwei Leute dieselbe
Stelle im Code ändern - Git markiert nur ehrlich, wo es nicht selbst entscheiden
kann. Der PR-Workflow fügt eine MENSCHLICHE Prüfung hinzu, bevor Code in `main` landet.

## Mini-Übung

1. Warum arbeitet man in Teams selten direkt auf `main`?
2. Was bedeuten die Markierungen `<<<<<<<`, `=======`, `>>>>>>>` in einer Datei?
3. Wozu dient ein Pull Request, wenn `git merge` das technisch auch allein könnte?

**Lösung:**
1. Damit `main` immer funktionsfähig bleibt, während an neuen Features gearbeitet
   wird, ohne den stabilen Stand zu gefährden.
2. Sie grenzen die beiden widersprüchlichen Versionen derselben Stelle ab (dein
   aktueller Stand vs. der eingemergte Branch) - du musst von Hand entscheiden,
   welche (oder beide) Versionen bleiben sollen.
3. Er bringt eine menschliche Prüfung (Code-Review) mit rein, BEVOR Code in `main`
   landet - reines `git merge` würde ungeprüft übernehmen.
