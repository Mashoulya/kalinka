#syntax=docker/dockerfile:1

FROM dunglas/frankenphp:1-php8.5 AS frankenphp_upstream
FROM composer:2 AS composer_upstream

FROM frankenphp_upstream AS frankenphp_base

SHELL ["/bin/bash", "-euxo", "pipefail", "-c"]

WORKDIR /app

VOLUME /app/var/

# =========================
# SYSTEM + PHP EXTENSIONS
# =========================
RUN <<-EOF
	apt-get update
	apt-get install -y --no-install-recommends \
		file \
		git \
		unzip \
		curl

	install-php-extensions \
		apcu \
		intl \
		opcache \
		zip \
		pdo_mysql

	rm -rf /var/lib/apt/lists/*
EOF

# =========================
# COMPOSER (IMPORTANT FIX)
# =========================
COPY --from=composer_upstream /usr/bin/composer /usr/local/bin/composer

# Allow Composer plugins when building as root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Cache dependencies at build time (use context root: ./backend)
COPY composer.json composer.lock symfony.lock ./
RUN composer install --no-cache --prefer-dist --no-dev --optimize-autoloader --no-scripts --no-interaction --no-progress

# ajoute PATH pour éviter ton bug "composer not found"
ENV PATH="/usr/local/bin:/usr/bin:/bin:/root/.composer/vendor/bin:${PATH}"

# =========================
# CONFIG PHP
# =========================
ENV PHP_INI_SCAN_DIR=":$PHP_INI_DIR/app.conf.d"

# =========================
# DOCKER ENTRYPOINTS
# =========================
COPY --link frankenphp/conf.d/10-app.ini $PHP_INI_DIR/app.conf.d/
COPY --link --chmod=755 frankenphp/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
COPY --link frankenphp/Caddyfile /etc/frankenphp/Caddyfile

ENTRYPOINT ["docker-entrypoint"]

CMD [ "frankenphp", "run", "--config", "/etc/frankenphp/Caddyfile" ]

# =========================
# DEV IMAGE
# =========================
FROM frankenphp_base AS frankenphp_dev

ENV APP_ENV=dev
ENV XDEBUG_MODE=off
ENV FRANKENPHP_WORKER_CONFIG=watch

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN install-php-extensions xdebug

COPY --link frankenphp/conf.d/20-app.dev.ini $PHP_INI_DIR/app.conf.d/

CMD [ "frankenphp", "run", "--config", "/etc/frankenphp/Caddyfile", "--watch" ]
