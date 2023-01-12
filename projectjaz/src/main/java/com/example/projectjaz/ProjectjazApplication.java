package com.example.projectjaz;

import com.example.projectjaz.entity.Author;
import com.example.projectjaz.repository.AuthorRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.CommandLineRunner;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;

@SpringBootApplication
public class ProjectjazApplication implements CommandLineRunner {

    @Autowired
    AuthorRepository authorRepository;


    public static void main(String[] args) {
        SpringApplication.run(ProjectjazApplication.class, args);
    }


    @Override
    public void run(String... args) throws Exception {
        authorRepository.save(new Author("Mike", "Todd"));

    }
}
