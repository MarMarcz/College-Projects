package com.example.projectjaz.service;

import com.example.projectjaz.entity.Author;

import java.util.List;
import java.util.Optional;

public interface AuthorService {
    List<Author> getAuthors();

    void saveAuthor(Author author);

   Author getAuthorById(Long id);
}
