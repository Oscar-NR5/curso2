#!/usr/bin/env bash
# Deja lista la aplicacion de Angular de la sesion 7 (carpeta frontend/).
#
# La base del curso trae el proyecto de Angular ya generado, con las versiones
# fijas (Angular 16.2, la de un sistema real en produccion) y el proxy hacia
# tu API de Laravel. Lo unico que falta es bajar sus dependencias: eso hace
# este script.
#
# Es IDEMPOTENTE: si ya las tienes, no hace nada.
#
#   bash .devcontainer/preparar-angular.sh
#
# El comando se ejecuta dentro del servicio Docker `angular`, no hace falta
# tener npm instalado en el host.
set -e

cd "$(dirname "$0")/.."

if [ ! -f frontend/package.json ]; then
    echo "No encuentro frontend/package.json."
    echo "Primero trae la base de la sesion 7, en la rama donde tienes tu trabajo:"
    echo "    git fetch upstream"
    echo "    git merge --no-edit upstream/main"
    exit 1
fi

if ! command -v docker >/dev/null 2>&1; then
    echo "No encuentro Docker. Arranca Docker y vuelve a ejecutar este script."
    exit 1
fi

cd frontend

echo ""
echo "=== Dependencias de Angular ==="
if [ -f node_modules/@angular/core/package.json ]; then
    version=$(docker compose run --rm angular node -p "require('./node_modules/@angular/core/package.json').version")
    echo "  [ya existe] Angular ${version}"
else
    echo "  Instalando: baja unos 300 MB y tarda un poco."
    echo "  npm va a imprimir avisos de paquetes viejos (deprecated). Son de las"
    echo "  herramientas de Angular 16, no de tu proyecto: no hay que hacer nada."
    echo ""
    # npm ci instala EXACTO lo que dice package-lock.json: todo el grupo queda
    # con las mismas versiones.
    docker compose run --rm angular npm ci --no-audit --no-fund
    echo ""
    echo "  [instalado] Dependencias de Angular"
fi

# Angular le pide los datos a tu API de Laravel: si falta, se avisa aqui.
cd ..
if [ ! -f artisan ]; then
    echo ""
    echo "AVISO: en esta carpeta no hay proyecto de Laravel (no encuentro 'artisan')."
    echo "       Tu aplicacion de Angular le pide los datos a tu API: avisa en el canal del curso."
elif [ ! -f routes/api.php ]; then
    echo ""
    echo "AVISO: tu proyecto todavia no tiene la API de la sesion 5 (routes/api.php)."
    echo "       Ponla antes de seguir:"
    echo "           bash .devcontainer/nivelar-api.sh"
fi

echo ""
echo "Listo. Para arrancar tu aplicacion de Angular, en OTRA terminal:"
echo "    docker compose up angular"
echo ""
echo "Abre el puerto 4200. Angular se conecta al servicio app de Laravel."
echo "La API queda disponible en el puerto 8001 del host."
echo ""
echo "Nota: al arrancar, Angular muestra un aviso en amarillo de que es un servidor"
echo "solo para desarrollo. Es esperado: compila y sirve igual."
