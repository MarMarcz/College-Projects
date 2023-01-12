package com.example.projectjaz.service;

import com.example.projectjaz.entity.Author;
import com.example.projectjaz.exception.AuthorNotFoundException;
import com.example.projectjaz.repository.AuthorRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class AuthorServiceImpl implements AuthorService{

    @Autowired
    AuthorRepository authorRepository;

    @Override
    public List<Author> getAuthors() {
        return (List<Author>) authorRepository.findAll();
    }

    @Override
    public void saveAuthor(Author author) {
        authorRepository.save(author);
    }

    @Override
    public Author getAuthorById(Long id) {
        Optional<Author> author = authorRepository.findById(id);
        if (author.isPresent()) {
            return author.get();
        } else {
            throw new AuthorNotFoundException(id);
        }
    }


}
