#!/usr/bin/env bash
# Deja lista la API de Django dentro del contenedor app. Se corre una sola vez,
# desde la raiz del proyecto:
#   docker compose run --rm app bash api-django/preparar-django.sh
set -e

cd "$(dirname "$0")"

echo ""
echo "==> 1/4  Revisando Python del contenedor"
if ! command -v python3 >/dev/null 2>&1; then
    echo "    No hay python3 en la imagen app. Reconstruye el contenedor y vuelve a intentar."
    exit 1
fi
echo "    $(python3 --version)"

if ! python3 -m venv --help >/dev/null 2>&1; then
    echo "    Falta el modulo venv en la imagen app. Reconstruye el contenedor y vuelve a intentar."
    exit 1
fi

echo ""
echo "==> 2/4  Entorno virtual"
if [ ! -d .venv ]; then
    python3 -m venv .venv
    echo "    Creado en api-django/.venv"
else
    echo "    Ya existia, lo reuso"
fi

echo ""
echo "==> 3/4  Django y Django REST Framework"
.venv/bin/pip install --quiet --upgrade pip
.venv/bin/pip install --quiet -r requirements.txt
echo "    Django $(.venv/bin/python -c 'import django;print(django.get_version())')"
echo "    DRF    $(.venv/bin/python -c 'import rest_framework;print(rest_framework.VERSION)')"

echo ""
echo "==> 4/4  Base de datos"
.venv/bin/python manage.py migrate --no-input >/dev/null
echo "    Migraciones aplicadas (SQLite, en api-django/db.sqlite3)"

echo ""
echo "  Listo. Para levantar la API:"
echo ""
echo "      docker compose exec app api-django/.venv/bin/python api-django/manage.py runserver 0.0.0.0:8001"
echo ""
echo "  Django queda en http://localhost:8002 (Laravel sigue en http://localhost:8001)."
echo ""
