# projet-web
script for the web project for the AMI2B master

#Pour info ouverture d'un répertoire GitHub
-ouvrir terminal
-aller dans le repertoire
-git remote add origin git@github.com:gnessou91/projet-web
-git pull origin master

et voilà!

#Autoriser l'accès aux fichiers en local sur mysql
SET GLOBAL local_infile=true;
SHOW GLOBAL VARIABLES LIKE 'local_infile';
LOAD DATA LOCAL INFILE 'path-to-my-csv'
INTO TABLE mytable
FIELDS TERMINATED BY ';' 
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;
