#!/bin/bash
set -e

APP_DIR="/var/www/aamavasf.com.br"
PHP="/usr/local/lsws/lsphp83/bin/php"

echo "🚀 Iniciando deploy AAMAVASF..."

cd "$APP_DIR"

# Ativar modo manutenção
$PHP artisan down --retry=15 --secret="aamavasf-manutencao"

# Atualizar código
git pull origin main

# Dependências PHP (sem dev)
composer install --no-dev --optimize-autoloader --no-interaction

# Dependências Node e build
npm ci
npm run build

# Banco de dados
$PHP artisan migrate --force

# Limpar e recriar caches de produção
$PHP artisan optimize:clear
$PHP artisan optimize
$PHP artisan storage:link --force

# OpenLiteSpeed: forçar reload do servidor para limpar opcode cache
sudo /usr/local/lsws/bin/lswsctrl restart

# Desativar modo manutenção
$PHP artisan up

echo "✅ Deploy concluído com sucesso!"
