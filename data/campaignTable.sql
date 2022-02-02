use edVoteDB;

CREATE TABLE campaignTable ( 
    campaign_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    election_id VARCHAR(30) NOT NULL, 
    school_id VARCHAR(30) NOT NULL, 
    department_id VARCHAR(30) NOT NULL,
    candidate_name VARCHAR(30) NOT NULL,
    candidate_party VARCHAR(30) NOT NULL,
    candidate_position VARCHAR(30) NOT NULL,
    profile_pic VARCHAR(100) NOT NULL,
    caption varchar(max) NOT NULL,
    varchar(max) NOT NULL,
    date TIMESTAMP,	
    images VARCHAR(100) NOT NULL,
);