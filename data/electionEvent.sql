use edVoteDB;
CREATE TABLE electionEvent ( 
    election_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    election_name VARCHAR(30) NOT NULL,
    start_election_date VARCHAR(15) NOT NULL,
    end_election_date VARCHAR(15) NOT NULL,
    department_id VARCHAR(80) NOT NULL,
    depatment_name VARCHAR(30) NOT NULL,
    school_id VARCHAR(30) NOT NULL,
    school_name VARCHAR(30) NOT NULL
);