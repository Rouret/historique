<?php

    $GLOBALS["db_setup"]=array(
        "CREATE TABLE History (refproject int NOT NULL,title varchar(30) COLLATE utf8_bin NOT NULL,description text COLLATE utf8_bin NOT NULL,date date NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;",
        "CREATE TABLE Projects (idproject int NOT NULL,refuser int NOT NULL,name varchar(30) COLLATE utf8_bin NOT NULL,compagny varchar(20) COLLATE utf8_bin NOT NULL,description text COLLATE utf8_bin NOT NULL,website text COLLATE utf8_bin NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;",
        "CREATE TABLE Users (iduser int NOT NULL,firstname varchar(20) COLLATE utf8_bin NOT NULL,lastname varchar(20) COLLATE utf8_bin NOT NULL,email varchar(30) COLLATE utf8_bin NOT NULL,tel varchar(15) COLLATE utf8_bin NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;",
        "ALTER TABLE History ADD KEY refproject (refproject);",
        "ALTER TABLE Projects ADD PRIMARY KEY (idproject), ADD KEY refuser (refuser);",
        "ALTER TABLE Users ADD PRIMARY KEY (iduser);",
        "ALTER TABLE Projects MODIFY idproject int NOT NULL AUTO_INCREMENT;",
        "ALTER TABLE Users MODIFY iduser int NOT NULL AUTO_INCREMENT;",
        "ALTER TABLE History ADD CONSTRAINT refproject FOREIGN KEY (refproject) REFERENCES Projects (idproject) ON DELETE CASCADE ON UPDATE CASCADE;",
        "ALTER TABLE Projects ADD CONSTRAINT refuser FOREIGN KEY (refuser) REFERENCES Users (iduser) ON DELETE CASCADE ON UPDATE CASCADE;"
    );
?>