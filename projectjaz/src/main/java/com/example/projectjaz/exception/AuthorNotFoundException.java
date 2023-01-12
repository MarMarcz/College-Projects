package com.example.projectjaz.exception;

public class AuthorNotFoundException extends RuntimeException {
    public AuthorNotFoundException(Long id) {
        super("Author id : " + id + " does not exist");
    }
}
