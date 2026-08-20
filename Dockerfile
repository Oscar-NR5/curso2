# ponytail: php:8.3-cli ya trae pdo_sqlite; solo faltan git/unzip para composer.
FROM php:8.3-cli
RUN apt-get update && apt-get install -y --no-install-recommends git unzip \
    && rm -rf /var/lib/apt/lists/*
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Usuario con el UID del host: da nombre al prompt y HOME propio (composer/git)
RUN useradd -u 1000 -m -s /bin/bash oscar-curso
