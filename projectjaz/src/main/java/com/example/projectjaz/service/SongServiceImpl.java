package com.example.projectjaz.service;

import com.example.projectjaz.entity.Author;
import com.example.projectjaz.entity.Song;
import com.example.projectjaz.repository.AuthorRepository;
import com.example.projectjaz.repository.SongRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import java.util.List;
import java.util.Optional;

@Service
public class SongServiceImpl implements SongService{

    @Autowired
    SongRepository songRepository;
    @Autowired
    AuthorRepository authorRepository;

    @Override
    public List<Song> getSongs() {
        return (List<Song>) songRepository.findAll();
    }

    @Override
    public List<Song> getAuthorSongs(Long authorId) {
        return songRepository.findByAuthorId(authorId);
    }

    @Override
    public Song saveSong(Song song, Long authorId) {

            Author author = AuthorServiceImpl.takeAuthorIfPresent(authorRepository.findById(authorId));
            song.setAuthor(author);

        return songRepository.save(song);
    }

    @Override
    public Song getSongById(Long id) {
        Optional<Song> song = songRepository.findById(id);
        return takeSongIfPresent(song);
    }

    @Override
    public void deleteById(Long id) {
        songRepository.deleteById(id);
    }

    public static Song takeSongIfPresent(Optional<Song> song) {
        if (song.isPresent())
            return song.get();
        //else throw new GradeNotFoundException(studentId, courseId);
        else
            throw new RuntimeException();
    }
}
