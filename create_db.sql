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

LOAD DATA LOCAL INFILE "/Users/agnesb/Sites/projet-web/bd/table_gene.csv"
INTO TABLE gene
FIELDS TERMINATED BY ";"
TERMINATED BY "\n"
IGNORE 1 LINES;

CREATE TABLE pfam(
  id int AUTO_INCREMENT,
  locus VARCHAR(10),
  code VARCHAR(10),
  domaine VARCHAR(50),
  start int,
  stop int,
  length int,
  pfam_code float,
  pfam_exp float,
  PRIMARY KEY(id),
  CONSTRAINT fk_locus_pfam FOREIGN KEY(locus) REFERENCES gene(locus)
);

LOAD DATA LOCAL INFILE "/Users/agnesb/Sites/projet-web/bd/table_pfam.csv"
INTO TABLE gene
FIELDS TERMINATED BY ";"
TERMINATED BY "\n"
IGNORE 1 LINES;

CREATE TABLE protein(
  transcrit VARCHAR(10),
  locus VARCHAR(10),
  length int,
  sequence text,
  PRIMARY KEY(transcrit, locus),
  CONSTRAINT fk_locus_prot FOREIGN KEY(locus) REFERENCES gene(locus)
);

LOAD DATA LOCAL INFILE "/Users/agnesb/Sites/projet-web/bd/proteins.csv"
INTO TABLE gene
FIELDS TERMINATED BY ";"
TERMINATED BY "\n"
IGNORE 1 LINES;
