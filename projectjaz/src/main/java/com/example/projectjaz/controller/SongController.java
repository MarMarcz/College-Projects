package com.example.projectjaz.controller;

import com.example.projectjaz.entity.Song;
import com.example.projectjaz.service.SongService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import java.util.List;

@RestController
@RequestMapping("/songs")
public class SongController {

    @Autowired
    SongService songService;

    @GetMapping("/all")
    public ResponseEntity<List<Song>> getSongs() {
        return new ResponseEntity<>(songService.getSongs(), HttpStatus.OK);
    }

    @GetMapping("/{id}")
    public ResponseEntity<Song> getSong(@PathVariable Long id) {
        return new ResponseEntity<>(songService.getSongById(id), HttpStatus.OK);
    }

    @GetMapping("/author/{id}")
    public ResponseEntity<List<Song>> getAuthorSongs(@PathVariable Long id){
        return new ResponseEntity<>(songService.getAuthorSongs(id), HttpStatus.OK);
    }

    @PostMapping("/save/{authorId}")
    public ResponseEntity<Song> saveSong(@RequestBody Song song, @PathVariable Long authorId) {//@Valid
        return new ResponseEntity<>(songService.saveSong(song, authorId), HttpStatus.CREATED);
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<HttpStatus> deleteSong(@PathVariable Long id) {
        songService.deleteById(id);
        return new ResponseEntity<>(HttpStatus.NO_CONTENT);
    }

}
