use edVoteDB;

CREATE TABLE candidateTable ( 
    candidate_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    school_id VARCHAR(30) NOT NULL, 
    department_id VARCHAR(30) NOT NULL,
    candidate_name VARCHAR(30) NOT NULL,
    candidate_party VARCHAR(30) NOT NULL,
    candidate_position VARCHAR(30) NOT NULL,
    profile_pic VARCHAR(100) NOT NULL
);