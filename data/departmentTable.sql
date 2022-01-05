use edVoteDB;

CREATE TABLE depatment_table ( 
    department_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    depatment_name VARCHAR(30) NOT NULL,
    depatment_name_abbreviation VARCHAR(30) NOT NULL,
    school_id VARCHAR(30) NOT NULL,
    school_name VARCHAR(30) NOT NULL
);