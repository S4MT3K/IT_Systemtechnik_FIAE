// ========================================================================
// CRUD: Create, Read, Update, Delete
// ========================================================================
// CRUD ist die Abkürzung für die vier grundlegenden Operationen, die
// praktisch JEDE Anwendung mit Daten braucht - ob Datenbank, Datei oder
// eben eine REST-API (siehe eigene Notiz). REST bildet CRUD direkt auf
// HTTP-Methoden ab:
//
//   CREATE -> POST    (neuen Datensatz anlegen)
//   READ   -> GET     (Datensatz(e) abrufen)
//   UPDATE -> PUT/PATCH (Datensatz ändern)
//   DELETE -> DELETE  (Datensatz löschen)

const basisUrl = "https://jsonplaceholder.typicode.com/posts";

async function crudDemo() {
    // ------------------------------------------------------------------
    // CREATE - neuen Datensatz anlegen (POST)
    // ------------------------------------------------------------------
    const createRes = await fetch(basisUrl, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ title: "Mein Titel", body: "Inhalt", userId: 1 }),
    });
    console.log("CREATE:", createRes.status, await createRes.json());
    // Status 201 (Created). Die Fake-API vergibt automatisch eine neue ID.


    // ------------------------------------------------------------------
    // READ - einen Datensatz abrufen (GET)
    // ------------------------------------------------------------------
    const readRes = await fetch(`${basisUrl}/1`);
    const gelesen = await readRes.json();
    console.log("READ:", readRes.status, gelesen.title);
    // Status 200 (OK).


    // ------------------------------------------------------------------
    // UPDATE mit PUT - den KOMPLETTEN Datensatz ersetzen
    // ------------------------------------------------------------------
    const updateRes = await fetch(`${basisUrl}/1`, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id: 1, title: "Geändert", body: "Neu", userId: 1 }),
    });
    console.log("UPDATE (PUT):", updateRes.status, await updateRes.json());
    // WICHTIG: PUT erwartet ALLE Felder - was du nicht mitschickst, würde in
    // einer echten API (anders als bei dieser Test-API) verloren gehen.


    // ------------------------------------------------------------------
    // UPDATE mit PATCH - NUR bestimmte Felder ändern
    // ------------------------------------------------------------------
    const patchRes = await fetch(`${basisUrl}/1`, {
        method: "PATCH",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ title: "Nur Titel geändert" }),
    });
    const gepatcht = await patchRes.json();
    console.log("UPDATE (PATCH):", patchRes.status, gepatcht);
    // Der Unterschied zu PUT: "body" bleibt hier der URSPRÜNGLICHE Wert,
    // weil wir bei PATCH nur "title" geschickt haben - alles andere bleibt
    // unangetastet.


    // ------------------------------------------------------------------
    // DELETE - Datensatz löschen
    // ------------------------------------------------------------------
    const deleteRes = await fetch(`${basisUrl}/1`, { method: "DELETE" });
    console.log("DELETE:", deleteRes.status); // 200 (OK) - erfolgreich gelöscht
}

crudDemo();

// Merksatz: PUT = "hier ist die KOMPLETTE neue Version", PATCH = "ändere
// NUR das hier, lass den Rest in Ruhe". Beide gehören zu UPDATE, aber die
// Wahl zwischen ihnen hat spürbare Konsequenzen für das, was du mitschicken musst.
