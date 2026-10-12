# api-django

La API de avisos en Django, para la sesion 9. Corre aparte de tu Laravel, en el puerto 8001.

Una sola vez:

```bash
docker compose build app
docker compose run --rm app bash api-django/preparar-django.sh
```

Para levantarla:

```bash
docker compose exec app api-django/.venv/bin/python api-django/manage.py runserver 0.0.0.0:8001
```

La API queda disponible en `http://localhost:8002`; Laravel queda disponible en `http://localhost:8001`.

Los archivos vienen casi vacios a proposito: los llenas en clase con las guias
`ejercicios/sesion9/01-django-de-cero.md` y `02-api-con-drf.md`.
