"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
function esAviso(x) {
    return typeof x === 'object' && x !== null
        && 'id' in x && typeof x.id === 'number'
        && 'titulo' in x && typeof x.titulo === 'string'
        && 'contenido' in x && typeof x.contenido === 'string'
        && 'creado' in x && typeof x.creado === 'string';
}
function avisosDe(cuerpo) {
    if (typeof cuerpo !== 'object' || cuerpo === null || !('data' in cuerpo) || !Array.isArray(cuerpo.data)) {
        throw new Error('La respuesta no trae el sobre "data"');
    }
    const todos = cuerpo.data;
    const buenos = todos.filter(esAviso);
    if (buenos.length < todos.length) {
        console.log(`  descartados: ${todos.length - buenos.length} de ${todos.length}`);
    }
    return buenos;
}
const buena = JSON.parse('{"data":[{"id":1,"titulo":"Simulacro","contenido":"A las 11","publicado":true,"creado":"2026-09-10T10:00:00-06:00"}]}');
const rota = JSON.parse('{"data":[{"id":"1","titulo":"Simulacro","contenido":"A las 11","publicado":true,"creado":"2026-09-10T10:00:00-06:00"}]}');
console.log('Buena:', avisosDe(buena).length);
console.log('Rota:', avisosDe(rota).length);
async function deTuApi() {
    const respuesta = await fetch('http://app:8000/api/avisos');
    const cuerpo = await respuesta.json();
    console.log('Tu API:', avisosDe(cuerpo).length, 'avisos con la forma de Aviso');
}
deTuApi();
function mensaje(estado) {
    switch (estado.tipo) {
        case 'cargando':
            return 'Cargando avisos...';
        case 'listo':
            return `${estado.avisos.length} avisos`;
        case 'invalido':
            return Object.values(estado.errores).flat().join(' ');
        case 'fallo':
            return `Tu API respondió ${estado.codigo}`;
        default: {
            const olvidado = estado;
            return olvidado;
        }
    }
}
const estados = [
    { tipo: 'cargando' },
    { tipo: 'listo', avisos: avisosDe(buena) },
    { tipo: 'invalido', errores: { titulo: ['The titulo field is required.'], contenido: ['The contenido field is required.'] } },
    { tipo: 'fallo', codigo: 403 }
];
for (const estado of estados) {
    console.log(`[${estado.tipo}]`, mensaje(estado));
}
const paraCrear = { titulo: 'Simulacro de sismo', contenido: 'A las 11, en el patio', categoria_id: 1 };
const aMedias = { titulo: 'Simulacro de sismo' };
const renglones = avisosDe(buena).map(({ id, titulo }) => ({ id, titulo }));
console.log('Para el POST:', paraCrear);
console.log('A medias:', aMedias);
console.log('Renglones:', renglones);
