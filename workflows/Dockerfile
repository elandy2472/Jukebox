# Usar una imagen base de Node.js
FROM node:18

# Instalar dependencias adicionales para PHP
RUN apt-get update && apt-get install -y \
    php \
    php-cli \
    php-mysql \
    curl

# Crear y establecer el directorio de trabajo
WORKDIR /app

# Copiar los archivos del proyecto al contenedor
COPY . .

# Instalar las dependencias del proyecto usando npm
RUN npm install

# Exponer el puerto en el que se ejecutará la aplicación
EXPOSE 3000

# Comando para iniciar la aplicación
CMD ["npm", "start"]
