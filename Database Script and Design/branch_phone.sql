DROP TABLE branch_phone;
CREATE TABLE branch_phone (
    branch_name VARCHAR(20),
    phone CHAR(11),
    PRIMARY KEY(phone,branch_name),
    CONSTRAINT fk8 FOREIGN KEY(branch_name)
    REFERENCES branch(name)
    );

INSERT INTO branch_phone(branch_name, phone) VALUES('Banani', '01700000000');
INSERT INTO branch_phone(branch_name, phone) VALUES('Basundhara', '01800000000');
INSERT INTO branch_phone(branch_name, phone) VALUES('Dhanmondi', '01900000000');