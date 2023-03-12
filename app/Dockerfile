FROM node:18

# Create working directory
RUN mkdir -p /var/www
 
WORKDIR /var/www

RUN npm install -g @angular/cli

# Copy all the app files to the working directory
COPY . .