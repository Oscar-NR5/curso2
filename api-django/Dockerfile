FROM python:3.13-slim

WORKDIR /app

COPY api-django/requirements.txt ./requirements.txt
RUN pip install --no-cache-dir -r requirements.txt

COPY api-django/ .
RUN mkdir -p /data

EXPOSE 8000

CMD ["sh", "-c", "python manage.py migrate --noinput && gunicorn config.wsgi:application --bind 0.0.0.0:8000 --workers 3"]
