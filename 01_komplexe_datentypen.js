// ========================================================================
// KOMPLEXE DATENTYPEN: null vs. undefined, Infinity, NaN (JavaScript)
// ========================================================================
// JavaScript unterscheidet - anders als PHP! - zwischen ZWEI "Nichts"-Werten:
// null und undefined. Das ist einer der bekanntesten Stolpersteine für
// Einsteiger:innen, die von PHP nach JS wechseln.

// ------------------------------------------------------------------
// undefined vs. null
// ------------------------------------------------------------------
// undefined: eine Variable EXISTIERT, hat aber (noch) keinen Wert bekommen.
// Das setzt JS automatisch, du musst es nicht selbst schreiben.

let deklariertAberLeer;
console.log(deklariertAberLeer); // undefined
console.log(typeof deklariertAberLeer); // "undefined"

// null: du hast BEWUSST "kein Wert" zugewiesen - eine aktive Entscheidung,
// kein automatischer Zustand.

let bewusstLeer = null;
console.log(bewusstLeer); // null

// Der berühmteste Bug der JavaScript-Geschichte:
console.log(typeof null); // "object" - das ist FALSCH und seit 1995 in JS
// aus Kompatibilitätsgründen nie mehr behoben worden. null ist KEIN Objekt,
// typeof lügt hier einfach.

// Vergleich der beiden:
console.log(null == undefined);  // true  - == ignoriert den Typ-Unterschied
console.log(null === undefined); // false - === unterscheidet sie korrekt

// Merksatz: === benutzen, dann bekommst du den echten Unterschied zu sehen.


// ------------------------------------------------------------------
// Infinity und -Infinity
// ------------------------------------------------------------------
// Anders als PHP (siehe .php-Datei!) führt eine Division durch 0 in
// JavaScript NICHT zu einem Fehler, sondern direkt zu Infinity:

console.log(1 / 0);   // Infinity  - kein Fehler, einfach ein Wert!
console.log(-1 / 0);  // -Infinity
console.log(typeof Infinity); // "number" - Infinity ist ganz normal eine Zahl


// ------------------------------------------------------------------
// NaN - "Not a Number"
// ------------------------------------------------------------------
console.log(0 / 0);        // NaN - unbestimmter Ausdruck
console.log(typeof NaN);   // "number" - NaN ist (verwirrenderweise) auch eine Zahl

// Genau wie in PHP: NaN ist NIE gleich sich selbst!
console.log(NaN === NaN);        // false
console.log(Number.isNaN(NaN));  // true - deswegen immer Number.isNaN() benutzen


// ------------------------------------------------------------------
// Komplexe/verschachtelte Datentypen
// ------------------------------------------------------------------
// Objekte und Arrays können beliebig tief verschachtelt werden - genau wie
// PHPs mehrdimensionale Arrays, nur mit geschweiften statt eckigen Klammern
// für Objekte:

const nutzer = {
    name: "Max",
    adresse: {
        stadt: "Berlin",
        plz: "10115"
    },
    hobbys: ["Programmieren", "Lesen"]
};

console.log(nutzer.adresse.stadt); // Berlin - Punkt-Notation statt PHPs Pfeil/Klammer
console.log(nutzer.hobbys[0]);     // Programmieren

// Merksatz: null = "ich habe bewusst nichts reingelegt", undefined = "hier
// wurde noch nie was reingelegt". PHP kennt nur die erste Idee (null), JS
// unterscheidet beide - das ist der Kernunterschied, den man sich merken muss.
