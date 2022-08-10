<?php
                if($to_do == "search_book")
                {
                    echo "
                         <div class='search'>
                            <form action='' method='POST'>
                                <div class='input'>
                                    <p class='label'>Enter ISBN</p>
                                    <input class='inputbox' type='number' name='isbn' required>
                                </div>
                                <button class='inputButton' name = 'search' type='submit'>Search Book</button>
                            </form>
                        </div>
                    ";
                }
                elseif($to_doc = "add_new_book")
                {
                    echo "
                        <div class='newBook'>
                            <p class='pp'>This book is not registered in the database, please add informations about this book
                            </p>
                            <form action='' method='POST'>
                                <div class='input'>
                                    <p class='label'>ISBN</p>
                                    <input class='inputbox' type='text' name='isbn' required>
                                </div>
                                <div class='input'>
                                    <p class='label'>Book Title</p>
                                    <input class='inputbox'  type='text' name='title' required>
                                </div>
                                <div class='input'>
                                    <p class='label'>Book Author</p>
                                    <input class='inputbox'  type='text' name='author' required>
                                </div>
                                 <div class='input' style='height: 60px;'>
                                    <p class='label'>Book Genre</p>
                                     <select class='label'  name='genre' id='genre'>
                                        <option value='Novel'>Novel</option>
                                        <option value='Drama'>Drama</option>
                                     </select>
                                </div>
                                 <div class='input'>
                                    <p class='label'>Publisher</p>
                                    <input class='inputbox'  type='text' name='publisher' require>
                                </div>
                            
                                <button class='inputButton' name = 'addNewBook' type='submit'>Add New Book </button>
                            
                            </form>
                        </div>
                    ";
                }
            ?>









            <div class='addThisBook'>
                <p class='label'>ISBN: $isbn></p>
                <p class='label'>Book Title: $title</p>
                <p class='label'>Author: $author</p>
                <p class='label'>Genre: $genre</p>
                <p class='label'>Publisher: $publisher</p>
                <form action='' method='POST'>
                    <div class='input'>
                        <p class='label'>Enter Number of copies to add</p>
                        <input class='inputbox' type='number' name='numOfCopy' required>
                    </div>
                    <button class='inputButton' name = 'addThisBook' type='submit'>Add This Book </button>
                </form>
           </div>