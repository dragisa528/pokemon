FROM node:18

# Create working directory
RUN mkdir -p /var/www/app
 
WORKDIR /var/www/app

USER node

COPY --chown=node:node ./src/ .
COPY --chown=node:node *.json ./

RUN npm install