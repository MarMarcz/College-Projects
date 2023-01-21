//package com.example.projectjaz.controller;
//
//import com.example.projectjaz.entity.Author;
//import com.example.projectjaz.service.AuthorService;
//import org.springframework.beans.factory.annotation.Autowired;
//import org.springframework.stereotype.Controller;
//import org.springframework.ui.Model;
//import org.springframework.web.bind.annotation.*;
//
//@Controller
//@RequestMapping("/authors")
//public class AuthorController {
//
//    @Autowired
//    AuthorService authorService;
//
//    @GetMapping("/all")
//    public String getAuthors(Model model){
//        model.addAttribute("authors", authorService.getAuthors());
//        return "authors";
//    }
//
//    @GetMapping("/add/")
//    public String getForm(Model model, @RequestParam(required = false) String id) {
//        if(id == null){
//            model.addAttribute("author", new Author());
//        }else {
//            Author authorById = authorService.getAuthorById(Long.valueOf(id));
//            model.addAttribute("author", authorById);
//        }
//        return "add_author";
//    }
//
//    @PostMapping("/submitAuthor")
//    public String handleSubmit(Author author){
//        authorService.saveAuthor(author);
//        return "redirect:/authors/all";
//    }
//
//    //@DeleteMapping("/")
//    @RequestMapping(value = "/", method = RequestMethod.POST)
//    public String deleteAuthor(@RequestParam(required = false) String id){
//        authorService.deleteById(Long.valueOf(id));
//        return "redirect:authors/all";
//    }
//
//}
