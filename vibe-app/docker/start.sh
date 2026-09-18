#!/usr/bin/env sh
set -e

mkdir -p storage/app/vivencia storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache

export APP_NAME="${APP_NAME:-Vivencia}"
export APP_ENV="${APP_ENV:-production}"
export APP_DEBUG="${APP_DEBUG:-false}"
export LOG_CHANNEL="${LOG_CHANNEL:-stderr}"
export LOG_LEVEL="${LOG_LEVEL:-info}"
export SESSION_DRIVER="${SESSION_DRIVER:-file}"
export CACHE_STORE="${CACHE_STORE:-file}"
export QUEUE_CONNECTION="${QUEUE_CONNECTION:-sync}"

if [ -z "${APP_URL:-}" ] && [ -n "${RENDER_EXTERNAL_URL:-}" ]; then
    export APP_URL="$RENDER_EXTERNAL_URL"
fi

if [ -z "${APP_URL:-}" ]; then
    export APP_URL="http://localhost:${PORT:-10000}"
fi

if [ -z "${APP_KEY:-}" ]; then
    export APP_KEY="$(php -r 'echo "base64:".base64_encode(random_bytes(32));')"
fi

php artisan config:clear
php artisan route:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

exec php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"
