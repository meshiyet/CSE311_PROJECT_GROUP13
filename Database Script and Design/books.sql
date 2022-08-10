INSERT INTO book (isbn, title, author, genre, publisher)
VALUES
('00001', 'The Maidens', 'Alex Michaelides','Psychological thriller ', 'Celadon Books')
('00002', 'The Alchemist', 'Paulo Coelho', 'Fantasy - Fantastic','HarperTorch'),


INSERT INTO keeps(branch_name, book_isbn, no_of_copies)
VALUES
('Banani', '00001', 5),
('Banani', '00002', 5),
('Dhanmondi', '00001', 5),
('Dhanmondi', '00002', 5);