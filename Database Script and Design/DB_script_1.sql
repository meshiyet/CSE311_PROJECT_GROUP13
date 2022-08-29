CREATE TABLE branch( 
    name VARCHAR(20) NOT NULL,
    address VARCHAR(30) NOT NULL, 
    Primary Key(name)
);


CREATE TABLE book( 
    isbn VARCHAR(15), 
    title VARCHAR(50) NOT NULL,
    author VARCHAR(30) NOT NULL, 
    genre VARCHAR (30) NOT NULL,
    publisher VARCHAR(40) NOT NULL, 
    cover LONGBLOB,
    Primary Key(isbn)
);


CREATE TABLE member( 
    username VARCHAR(20) NOT NULL,
    password VARCHAR(250) NOT NULL, 
    first_name VARCHAR(15) NOT NULL,
    middle_name VARCHAR(15),
    last_name VARCHAR(15),
    dob DATE,
    gender VARCHAR(8),
    email VARCHAR(30),
    phone VARCHAR(20),
    address VARCHAR(50),
    photo LONGBLOB,
    Primary Key(username)
);


CREATE TABLE admin(
    username VARCHAR(20) NOT NULL,
    password VARCHAR(250) NOT NULL, 
    first_name VARCHAR(15) NOT NULL,
    middle_name VARCHAR(15),
    last_name VARCHAR(15) NOT NULL,
    dob DATE,
    gender VARCHAR(8),
    email VARCHAR(30),
    phone VARCHAR(20),
    address VARCHAR(50),
    photo LONGBLOB,
    start_date DATE,
    Primary Key(username),
    branch_name VARCHAR(20),
    CONSTRAINT fk1 FOREIGN KEY(branch_name)
    REFERENCES branch(name)
);


branch_id

CREATE TABLE keeps(
    branch_name VARCHAR(20),
    book_isbn VARCHAR(30),
    no_of_copies INT(10),
    PRIMARY KEY (branch_name,book_isbn),
    CONSTRAINT fk3 FOREIGN KEY(branch_name)
    REFERENCES branch(name),
    CONSTRAINT fk4 FOREIGN KEY(book_isbn)
    REFERENCES book(isbn)
);


CREATE TABLE loans(
    branch_name VARCHAR(20),
    book_isbn VARCHAR(30),
    member_username varchar(30),
    borrow_date DATE,
    return_date DATE,
    fee INT(5),
    PRIMARY KEY (branch_name,book_isbn,member_username),
    CONSTRAINT fk5 FOREIGN KEY(branch_name)
    REFERENCES branch(name),
    CONSTRAINT fk6 FOREIGN KEY(book_isbn)
    REFERENCES book(isbn),
    CONSTRAINT fk7 FOREIGN KEY(member_username)
    REFERENCES member(username)
);



CREATE TABLE branch_phone(
    branch_name VARCHAR(20),
    phone INT(30),
    PRIMARY KEY(phone,branch_name),
    CONSTRAINT fk8 FOREIGN KEY(branch_name)
    REFERENCES branch(name)
);
CREATE TABLE review (
    
    review_id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(20),
    isbn VARCHAR(15),
    created DATETIME,
    review_text VARCHAR(1000),
    PRIMARY KEY(review_id), 
    CONSTRAINT fk9 FOREIGN KEY(username)
    REFERENCES member(username),
    CONSTRAINT fk10 FOREIGN KEY(isbn)
    REFERENCES book(isbn),

);
CREATE TABLE wishlist(
    isbn VARCHAR(15),
    username VARCHAR(20),
    PRIMARY KEY(isbn,username),
    CONSTRAINT fk11 FOREIGN KEY(username)
    REFERENCES member(username),
    CONSTRAINT fk12 FOREIGN KEY(isbn)
    REFERENCES book(isbn),
);




INSERT INTO branch (name, address)
VALUES
	('Banani', '150/6, Block-D, G Road'),
	('Basundhara', '52/15, Block-G, Y Road'),
	('Dhanmondi', '89/8, Block-D, Kichuekta Road');




INSERT INTO admin (username,password,first_name,middle_name,last_name,dob,gender,email,phone,address,start_date,branch_name)
VALUES
	('tahmid', 'password', 'Tahmid','Ahmed','Rakib','2001-11-22','Male','withtahmid@gmail.com.com','01750716668','150/6, KURIL, G Road','1979-10-31','Banani'),
	('02', 'abcd', 'Anuradha','Shivshankar','Panikar','1959-10-25','Female','anuradha@herapheri.com','01234524455','52/15, Block-G, Y Road','1983-11-16','Basundhara'),
	('', 'abcd', 'Kharakh','Singh','H','1961-11-25','Male','kharakhsing@herapheri.com','01234524455','89/8, Block-D, Chayabithi Road','1953-12-31','Dhanmondi'),
    
    ('03', 'abcd', 'Kachra','Seth','J','1945-12-18','Male','kachra@herapheri.com','01234524455','150/6, Block-D, G Road','1979-11-10','Banani'),
	('04', 'abcd', 'Kabira','Speeking','K','1959-10-31','Male','kabira@herapheri.com','01234524455','52/15, Block-G, Y Road','1983-11-13','Basundhara'),
	('05', 'abcd', 'Devi','Prashad','L','1931-11-21','Male','devi@herapheri.com','01234524455','89/8, Block-D, Chayabithi Road','1953-11-14','Dhanmondi');

