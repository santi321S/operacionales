#!/bin/bash

# Variables
IMAGE_NAME="MenesesEscobar"
CONTAINER_NAME="MenesesEscobar_container"
PORT=80

echo "Construyendo la imagen Docker..."
docker build -t $IMAGE_NAME .

echo "Deteniendo y eliminando contenedores existentes..."
docker stop $CONTAINER_NAME || true
docker rm $CONTAINER_NAME || true

echo "Iniciando un nuevo contenedor..."
docker run -d -p $PORT:80 --name $CONTAINER_NAME $IMAGE_NAME

echo "Despliegue completado. Contenedor activo en el puerto $PORT."
