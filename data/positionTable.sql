use edVoteDB;

CREATE TABLE positionTable ( 
    position_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    school_id VARCHAR(30) NOT NULL, 
    position_name VARCHAR(30) NOT NULL
);