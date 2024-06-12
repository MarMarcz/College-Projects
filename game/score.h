#ifndef SCORE_H
#define SCORE_H

#include <SDL.h>
#include <SDL_ttf.h>

void renderScore(SDL_Renderer* renderer, TTF_Font* font, SDL_Color color, int score, int highScore);

#endif
