#cmake_minimum_required(VERSION 3.17)
#project(game)
#
#set(CMAKE_CXX_STANDARD 17)
#
## Ustaw ścieżkę do katalogu z nagłówkami SDL i SDL_ttf
#include_directories(/opt/homebrew/include/SDL2)
#
## Dodaj biblioteki SDL i SDL_ttf
#find_library(SDL2_LIBRARY SDL2 HINTS /opt/homebrew/lib)
#find_library(SDL2_IMAGE_LIBRARY SDL2_image HINTS /opt/homebrew/lib)
#find_library(SDL2_TTF_LIBRARY SDL2_ttf HINTS /opt/homebrew/lib)
#
## Dodaj pliki źródłowe twojego projektu
#add_executable(game main.cpp)
#
## Podlinkuj biblioteki SDL i SDL_ttf
#target_link_libraries(game ${SDL2_LIBRARY} ${SDL2_IMAGE_LIBRARY} ${SDL2_TTF_LIBRARY})

cmake_minimum_required(VERSION 3.17)
project(game)

set(CMAKE_CXX_STANDARD 17)

# Ustaw ścieżkę do katalogu z nagłówkami SDL
include_directories(/opt/homebrew/include/SDL2)

# Dodaj biblioteki SDL
find_library(SDL2_LIBRARY SDL2 HINTS /opt/homebrew/lib)
find_library(SDL2_IMAGE_LIBRARY SDL2_image HINTS /opt/homebrew/lib)
find_library(SDL2_TTF_LIBRARY SDL2_ttf HINTS /opt/homebrew/lib)

# Dodaj pliki źródłowe twojego projektu
add_executable(game main.cpp platform.cpp texture.cpp score.cpp)

# Podlinkuj biblioteki SDL
target_link_libraries(game ${SDL2_LIBRARY} ${SDL2_IMAGE_LIBRARY} ${SDL2_TTF_LIBRARY})



