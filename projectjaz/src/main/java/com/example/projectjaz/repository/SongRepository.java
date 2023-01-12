package com.example.projectjaz.repository;

import com.example.projectjaz.entity.Song;
import org.springframework.data.repository.CrudRepository;

public interface SongRepository extends CrudRepository<Song, Long> {

}
