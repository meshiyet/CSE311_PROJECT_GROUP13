CREATE TABLE branch( 
    id INT(10) NOT NULL, 
    name VARCHAR(20) NOT NULL,
    address VARCHAR(30) NOT NULL, 
    Primary Key(id,name)
);


CREATE TABLE book( 
    isbn INT(15), 
    title VARCHAR(30) NOT NULL,
    author VARCHAR(20) NOT NULL, 
    publisher VARCHAR(20) NOT NULL, 
    cover VARCHAR(20),
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





INSERT INTO branch (id, name, address)
VALUES
	(01, 'Banani', '150/6, Block-D, G Road'),
	(02, 'Kataban', '52/15, Block-G, Y Road'),
	(03, 'Gazipur', '89/8, Block-D, Chayabithi Road');




INSERT INTO admin (id,password,first_name,middle_name,last_name,dob,gender,email,phone,address,start_date,branch_id,branch_name)
VALUES
	('tahmid', 'password', 'Tahmid','Ahmed','Rakib','2001-11-22','Male','withtahmid@gmail.com.com','01750716668','150/6, KURIL, G Road','1979-10-31',01,'Banani'),
	('02', 'abcd', 'Anuradha','Shivshankar','Panikar','1959-10-25','Female','anuradha@herapheri.com','01234524455','52/15, Block-G, Y Road','1983-11-16',02,'Kataban'),
	('', 'abcd', 'Kharakh','Singh','H','1961-11-25','Male','kharakhsing@herapheri.com','01234524455','89/8, Block-D, Chayabithi Road','1953-12-31',03,'Gazipur'),
    
    ('03', 'abcd', 'Kachra','Seth','J','1945-12-18','Male','kachra@herapheri.com','01234524455','150/6, Block-D, G Road','1979-11-10',01,'Banani'),
	('04', 'abcd', 'Kabira','Speeking','K','1959-10-31','Male','kabira@herapheri.com','01234524455','52/15, Block-G, Y Road','1983-11-13',02,'Kataban'),
	('05', 'abcd', 'Devi','Prashad','L','1931-11-21','Male','devi@herapheri.com','01234524455','89/8, Block-D, Chayabithi Road','1953-11-14',03,'Gazipur');

