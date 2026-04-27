#!/bin/bash
set -e

APP_DIR="/var/www/aamavasf.com.br"

echo "🚀 Iniciando deploy AAMAVASF..."

cd "$APP_DIR"

# Ativar modo manutenção
php artisan down --retry=15 --secret="aamavasf-manutencao"

# Atualizar código
git pull origin main

# Dependências PHP (sem dev)
composer install --no-dev --optimize-autoloader --no-interaction

# Dependências Node e build
npm ci
npm run build

# Banco de dados
php artisan migrate --force

# Limpar e recriar caches de produção
php artisan optimize:clear
php artisan optimize
php artisan storage:link --force

# Reiniciar PHP-FPM
sudo systemctl reload php8.3-fpm

# Desativar modo manutenção
php artisan up

echo "✅ Deploy concluído com sucesso!"
