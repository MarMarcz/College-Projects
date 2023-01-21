package com.example.projectjaz.controller;

import com.example.projectjaz.entity.Author;
import com.example.projectjaz.service.AuthorService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import java.util.List;

@RestController
@RequestMapping("/authors")
public class AuthorController {

        @Autowired
        AuthorService authorService;

        @GetMapping("/all")
        public ResponseEntity<List<Author>> getAuthors() {
            return new ResponseEntity<>(authorService.getAuthors(), HttpStatus.OK);
        }

        @GetMapping("/{id}")
        public ResponseEntity<Author> getAuthor(@PathVariable Long id) {
            return new ResponseEntity<>(authorService.getAuthorById(id), HttpStatus.OK);
        }

        @PostMapping("/save")
        public ResponseEntity<Author> saveAuthor(@RequestBody Author author) {//@Valid
            return new ResponseEntity<>(authorService.saveAuthor(author), HttpStatus.CREATED);
        }

        @DeleteMapping("/{id}")
        public ResponseEntity<HttpStatus> deleteAuthor(@PathVariable Long id) {
            authorService.deleteById(id);
            return new ResponseEntity<>(HttpStatus.NO_CONTENT);
        }

    }

