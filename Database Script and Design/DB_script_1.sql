CREATE TABLE branch( 
    id INT(10) NOT NULL, 
    name VARCHAR(20) NOT NULL,
    address VARCHAR(30) NOT NULL, 
    Primary Key(id,name)
);


CREATE TABLE book( 
    isbn INT(15), 
    title VARCHAR(15) NOT NULL,
    author VARCHAR(20) NOT NULL, 
    publisher VARCHAR(20) NOT NULL, 
    cover VARCHAR(20),
    Primary Key(isbn)
);



CREATE TABLE member( 
    username VARCHAR(20) NOT NULL,
    password INT(50) NOT NULL, 
    first_name VARCHAR(15) NOT NULL,
    middle_name VARCHAR(15),
    last_name VARCHAR(15) NOT NULL,
    dob DATE,
    gender VARCHAR(8),
    email VARCHAR(30),
    phone INT(11),
    address VARCHAR(50),
    photo LONGBLOB,
    Primary Key(username)
);

CREATE TABLE admin(
    id INT(10) NOT NULL,
    password INT(50) NOT NULL, 
    first_name VARCHAR(15) NOT NULL,
    middle_name VARCHAR(15),
    last_name VARCHAR(15) NOT NULL,
    dob DATE,
    gender VARCHAR(8),
    email VARCHAR(30),
    phone INT(11),
    address VARCHAR(50),
    photo LONGBLOB,
    start_date DATE,
    Primary Key(id),
    branch_id INT(10),
    branch_name VARCHAR(20),
    CONSTRAINT fk1 FOREIGN KEY(branch_id, branch_name)
    REFERENCES branch(id, name)
);




CREATE TABLE keeps(
    branch_id INT(10),
    branch_name VARCHAR(20),
    book_isbn INT(30),
    no_of_copies INT(10),
    PRIMARY KEY (branch_id, branch_name,book_isbn),
    CONSTRAINT fk3 FOREIGN KEY(branch_id, branch_name)
    REFERENCES branch(id, name),
    CONSTRAINT fk4 FOREIGN KEY(book_isbn)
    REFERENCES book(isbn)
);



CREATE TABLE loans(
    branch_id INT(10),
    branch_name VARCHAR(20),
    book_isbn INT(30),
    member_username varchar(30),
    borrow_date DATE,
    return_date DATE,
    fee INT(5),
    PRIMARY KEY (branch_id, branch_name,book_isbn,member_username),
    CONSTRAINT fk5 FOREIGN KEY(branch_id, branch_name)
    REFERENCES branch(id, name),
    CONSTRAINT fk6 FOREIGN KEY(book_isbn)
    REFERENCES book(isbn),
    CONSTRAINT fk7 FOREIGN KEY(member_username)
    REFERENCES member(username)
);



CREATE TABLE branch_phone(
    branch_id INT(10),
    branch_name VARCHAR(20),
    phone INT(30),
    PRIMARY KEY(phone,branch_id, branch_name),
    CONSTRAINT fk8 FOREIGN KEY(branch_id, branch_name)
    REFERENCES branch(id, name)
);