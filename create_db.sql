CREATE TABLE gene(
  locus VARCHAR(10),
  length int,
  start int,
  stop int,
  strand VARCHAR(1),
  fonction VARCHAR(50),
  sequence text,
  PRIMARY KEY(locus)
);

CREATE TABLE pfam(
  id int AUTO_INCREMENT,
  locus VARCHAR(10),
  pfam_code VARCHAR(10),
  domaine VARCHAR(50),
  pfam_start int,
  pfam_stop int,
  length int,
  pfam_score float,
  pfam_exp float,
  PRIMARY KEY(id),
  CONSTRAINT fk_locus_pfam FOREIGN KEY(locus) REFERENCES gene(locus)
);

CREATE TABLE protein(
  id_transcrit VARCHAR(10),
  id_gene VARCHAR(10),
  length int,
  sequence text,
  PRIMARY KEY(id_transcrit, id_gene),
  CONSTRAINT fk_locus_prot FOREIGN KEY(id_gene) REFERENCES gene(locus)
);


LOAD DATA LOCAL INFILE "/var/www/html/projet-web/bd/table_gene.csv"
INTO TABLE gene
COLUMNS TERMINATED BY ";"
LINES TERMINATED BY "\n"
IGNORE 1 LINES;

LOAD DATA LOCAL INFILE "/var/www/html/projet-web/bd/table_pfam.csv"
INTO TABLE pfam
COLUMNS TERMINATED BY ";"
LINES TERMINATED BY "\n"
IGNORE 1 LINES
(locus, pfam_code, domaine, pfam_start, pfam_stop, length, pfam_score, pfam_exp);

LOAD DATA LOCAL INFILE "/var/www/html/projet-web/bd/proteins.csv"
INTO TABLE protein
COLUMNS TERMINATED BY ";"
LINES TERMINATED BY "\n"
IGNORE 1 LINES;
