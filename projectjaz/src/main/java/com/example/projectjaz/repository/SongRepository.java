package com.example.projectjaz.repository;

import com.example.projectjaz.entity.Song;
import org.springframework.data.repository.CrudRepository;

import java.util.List;

public interface SongRepository extends CrudRepository<Song, Long> {
    List<Song> findByAuthorId(Long authorId);
}
