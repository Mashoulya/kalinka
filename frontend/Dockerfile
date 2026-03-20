FROM node:lts-alpine

WORKDIR /app

# Copier uniquement les fichiers de dépendances
COPY package*.json ./

# Installer les dépendances
RUN npm install

# Copier le reste du projet
COPY . .

# Exposer le port Vite
EXPOSE 5173

# Lancer le serveur de dev Vite
CMD ["npm", "run", "dev", "--", "--host"]