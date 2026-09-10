// ========================================================================
// REKURSION (JavaScript)
// ========================================================================
// Gleiches Prinzip wie in der PHP-Datei: eine Funktion ruft sich selbst mit
// einem kleineren Teilproblem auf, bis ein Basisfall erreicht ist.

function fakultaet(n) {
    if (n <= 1) return 1; // Basisfall
    return n * fakultaet(n - 1);
}
console.log(fakultaet(5)); // 120


// ------------------------------------------------------------------
// Rekursion über Arrays - "Kopf und Rest" zerlegen
// ------------------------------------------------------------------
// Ein sehr JS-typisches Muster: das Array in "erstes Element" + "der Rest"
// zerlegen (Destrukturierung mit Spread-Operator "..."), und den Rest
// rekursiv weiterverarbeiten:

const summeArray = (array) => {
    if (array.length === 0) {
        return 0; // Basisfall: ein leeres Array hat die Summe 0
    }
    const [erstes, ...rest] = array; // "erstes" = array[0], "rest" = alles danach
    return erstes + summeArray(rest);
};

console.log(summeArray([1, 2, 3, 4, 5])); // 15

// Ablauf: summeArray([1,2,3,4,5])
//       = 1 + summeArray([2,3,4,5])
//       = 1 + (2 + summeArray([3,4,5]))
//       = 1 + (2 + (3 + summeArray([4,5])))
//       = ... bis summeArray([]) = 0 den Basisfall auslöst

// Merksatz: Egal in welcher Sprache - Rekursion braucht IMMER (1) einen
// Basisfall, der OHNE weiteren rekursiven Aufruf direkt antwortet, und
// (2) einen rekursiven Schritt, der das Problem nachweisbar VERKLEINERT
// (hier: ein Element weniger im Array), damit der Basisfall irgendwann
// garantiert erreicht wird.
