#!/bin/bash

# Variables
REPO_URL="https://github.com/elandy2472/Jukebox.git"
PROJECT_DIR="jukebox"

# Clonar repositorio si no existe
if [ ! -d "$PROJECT_DIR" ]; then
  echo "Clonando el repositorio..."
  git clone $REPO_URL
else
  echo "El repositorio ya está clonado."
fi

# Entrar al directorio del proyecto
cd $PROJECT_DIR

# Construir y levantar contenedores
echo "Construyendo y levantando contenedores..."
docker-compose up -d
