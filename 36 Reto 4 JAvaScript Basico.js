
let nombreCompleto;
let edad;
let teGustaProgramacion;

nombreCompleto = "Felix Lopez";
edad = 66;
teGustaProgramacion = false;
intereses = ["programacion", "Pasear", "Reuniones familiares"];

let persona = {
    nombre: nombreCompleto,
    años: edad,
    programacion:teGustaProgramacion
}


let campo;
let valor;
for (const key in persona) {
    const campo = key;
    let valor = persona[key];
    if (campo === "programacion" && valor === true) {
        valor = "Si"
        
    } else {
        if (campo === "programacion" && valor === false) {
            valor = "No"
        }
    }
    

    console.log(campo + `  ` + valor);
}