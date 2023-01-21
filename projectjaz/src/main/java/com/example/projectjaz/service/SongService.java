package com.example.projectjaz.service;

import com.example.projectjaz.entity.Song;

import java.util.List;

public interface SongService {

    List<Song> getSongs();

    List<Song> getAuthorSongs(Long authorId);

    Song saveSong(Song song, Long authorId);

    Song getSongById(Long id);

    void deleteById(Long id);


//    Grade saveGrade(Grade grade, Long studentId, Long courseId);
//    Grade updateGrade(String score, Long studentId, Long courseId);
//    List<Grade> getCourseGrades(Long courseId);

}
