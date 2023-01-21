package com.example.projectjaz.service;

import com.example.projectjaz.entity.Author;
import com.example.projectjaz.entity.Song;

import java.util.List;
import java.util.Optional;

public interface AuthorService {
    List<Author> getAuthors();

    Author saveAuthor(Author author);

   Author getAuthorById(Long id);

    void deleteById(Long id);
}
