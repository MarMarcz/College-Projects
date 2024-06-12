#ifndef TEXTURE_H
#define TEXTURE_H

#include <SDL.h>
#include <string>
#include <filesystem>

SDL_Texture* loadTexture(SDL_Renderer* renderer, const std::string& path);
void cleanup(SDL_Renderer* renderer, SDL_Window* window);
std::string getResourcePath(const std::string &subDir = "");

#endif
