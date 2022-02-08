use edVoteDB;

CREATE TABLE balot_counting_table ( 
    voters_vote_id  INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    school_id VARCHAR(30) NOT NULL, 
    election_id VARCHAR(30) NOT NULL, 
    department_id VARCHAR(30) NOT NULL,
    candidate_id VARCHAR(30) NOT NULL,
    candidate_name VARCHAR(30) NOT NULL,
    candidate_party VARCHAR(30) NOT NULL,
    candidate_position VARCHAR(30) NOT NULL
);