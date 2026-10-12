"use strict";
const avisos = [
    { id: 1, titulo: 'Cambio de horario en barandilla', categoria: { id: 1, nombre: 'Aviso' }, creado: '2026-09-10T10:00:00-06:00' },
    { id: 2, titulo: 'Curso de primeros auxilios', creado: '2026-09-09T09:00:00-06:00' }
];
function vencimiento(fecha, dias) {
    const dia = new Date(fecha);
    dia.setDate(dia.getDate() + dias);
    return dia;
}
function titulares(lista) {
    return lista.map(aviso => aviso.titulo.toUpperCase());
}
function categorias(lista) {
    return lista.map(aviso => aviso.categoria?.nombre ?? 'Sin categoría');
}
console.log('Vence:', vencimiento(avisos[0].creado, 3).toISOString().slice(0, 10));
// La regla de create() de tu PostPolicy, del lado de la pantalla.
function puedeCrear(sesion) {
    if (sesion === null) {
        return false;
    }
    return sesion.rol === 'admin' || sesion.rol === 'editor';
}
const editor = { token: 'abc', usuario: 'Editor de guardia', rol: 'editor' };
console.log('¿Puede crear el editor?', puedeCrear(editor));
console.log('¿Y sin sesión?', puedeCrear(null));
function sacar(respuesta) {
    return respuesta.data;
}
const muchos = { data: avisos };
const uno = { data: avisos[0] };
console.log('Cuántos:', sacar(muchos).length);
console.log('Uno:', sacar(uno).titulo);
class AvisosRepositorio {
    base;
    pedidas = 0;
    constructor(base) {
        this.base = base;
    }
    async listar() {
        this.pedidas++;
        const respuesta = await fetch(`${this.base}/api/avisos`);
        const cuerpo = await respuesta.json();
        return cuerpo.data;
    }
    get veces() {
        return this.pedidas;
    }
}
async function main() {
    const repo = new AvisosRepositorio('http://app:8000');
    const deTuApi = await repo.listar();
    console.log('Desde tu API:', titulares(deTuApi));
    console.log('Sus categorías:', categorias(deTuApi));
    console.log('Peticiones hechas:', repo.veces);
}
main();
