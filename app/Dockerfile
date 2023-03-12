FROM node:18

# Create working directory
RUN mkdir -p /var/www/app
 
WORKDIR /var/www/app

RUN npm install -g @angular/cli

# Copy all the app files to the working directory
COPY . .