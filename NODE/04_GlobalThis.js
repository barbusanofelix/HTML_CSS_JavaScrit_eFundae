
// globalThis es el padre de todas las variables en Java Script

// No necesitarias hacer esto porque globalThis ya esta incluida
//const global = require(`globalthis`);

const variableGlobal = globalThis;

console.log(variableGlobal); // global es globalThis

for (elemento in variableGlobal) {
    console.log(`el elementpo es $[elemento]`)

}



