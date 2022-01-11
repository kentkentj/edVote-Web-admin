use edVoteDB;

CREATE TABLE studentUserTable ( 
    user_id VARCHAR(300), 
    student_id INT(11),
    department_id INT(11),
    firstname VARCHAR(30) NOT NULL, 
    lastname VARCHAR(30) NOT NULL,
    middlename VARCHAR(30) NOT NULL,
    suffix VARCHAR(30) NOT NULL,
    profile_pic VARCHAR(100) NOT NULL,
    email VARCHAR(30) NOT NULL,
    phonenumber VARCHAR(30) NOT NULL,
    depatment_name VARCHAR(80) NOT NULL,
    department_name_abbreviation VARCHAR(30) NOT NULL,
    school_id VARCHAR(30) NOT NULL,
    school_name VARCHAR(30) NOT NULL,
    course VARCHAR(30) NOT NULL,
    year_level VARCHAR(30) NOT NULL,
    account_status VARCHAR(10) NOT NULL
);