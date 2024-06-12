#include "texture.h"
#include <iostream>
#include <SDL_image.h>
#include <SDL_ttf.h>

SDL_Texture* loadTexture(SDL_Renderer* renderer, const std::string& path) {
    std::string fullPath = getResourcePath(path);
    if (!std::filesystem::exists(fullPath)) {
        std::cerr << "File does not exist: " << fullPath << std::endl;
        return nullptr;
    }
    SDL_Texture* newTexture = IMG_LoadTexture(renderer, fullPath.c_str());
    if (!newTexture) {
        std::cerr << "Failed to load texture: " << fullPath << " " << IMG_GetError() << std::endl;
    }
    return newTexture;
}

void cleanup(SDL_Renderer* renderer, SDL_Window* window) {
    TTF_Quit();
    IMG_Quit();
    SDL_DestroyRenderer(renderer);
    SDL_DestroyWindow(window);
    SDL_Quit();
}

std::string getResourcePath(const std::string &subDir) {
    std::filesystem::path basePath = std::filesystem::current_path();
    basePath = basePath.parent_path(); // Wstecz do katalogu nadrzędnego
    basePath /= "assets"; // Dodaj katalog assets
    if (!subDir.empty()) {
        basePath /= subDir;
    }
    return basePath.string();
}
