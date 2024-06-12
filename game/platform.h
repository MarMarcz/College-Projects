#ifndef PLATFORM_H
#define PLATFORM_H

#include <SDL.h>
#include <vector>

struct Platform {
    int x, y;
    int width, height;
    bool isVisited;
    SDL_Texture* texture;
    SDL_Texture* visitedTexture;
};

extern std::vector<Platform> platforms;

extern const int PLATFORM_WIDTH;
extern const int PLATFORM_HEIGHT;
extern const int PLATFORM_SPACING;
extern const int MAX_PLATFORMS;
extern const int MAX_HORIZONTAL_DISTANCE;

extern const int SCREEN_WIDTH;
extern const int SCREEN_HEIGHT;
extern const int SQUARE_SIZE;

extern SDL_Texture* platformTexture;
extern SDL_Texture* visitedPlatformTexture;

void initPlatforms(SDL_Renderer* renderer);
void generatePlatform(int minY);
bool checkCollision(int squareX, int squareY, int squareSize, Platform platform);

#endif
