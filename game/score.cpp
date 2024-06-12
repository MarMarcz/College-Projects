#include "score.h"
#include <string>
#include "texture.h"
#include <iostream>

SDL_Texture* renderText(SDL_Renderer* renderer, const std::string& message, SDL_Color color, TTF_Font* font) {
    SDL_Surface* surf = TTF_RenderText_Blended(font, message.c_str(), color);
    if (!surf) {
        std::cerr << "Failed to render text to surface: " << TTF_GetError() << std::endl;
        return nullptr;
    }
    SDL_Texture* texture = SDL_CreateTextureFromSurface(renderer, surf);
    SDL_FreeSurface(surf);
    if (!texture) {
        std::cerr << "Failed to create texture from surface: " << SDL_GetError() << std::endl;
    }
    return texture;
}

void renderScore(SDL_Renderer* renderer, TTF_Font* font, SDL_Color color, int score, int highScore) {
    std::string scoreText = "Score: " + std::to_string(score) + " High Score: " + std::to_string(highScore);
    SDL_Texture* scoreTexture = renderText(renderer, scoreText, color, font);
    if (scoreTexture) {
        int textW = 0, textH = 0;
        SDL_QueryTexture(scoreTexture, NULL, NULL, &textW, &textH);
        SDL_Rect textRect = {10, 10, textW, textH};
        SDL_RenderCopy(renderer, scoreTexture, NULL, &textRect);
        SDL_DestroyTexture(scoreTexture);
    }
}
