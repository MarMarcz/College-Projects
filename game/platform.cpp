#include "platform.h"
#include "texture.h"
#include <cstdlib>
#include <ctime>
#include <iostream>
#include <SDL_image.h>

// Stałe zdefiniowane w main.cpp
extern const int SCREEN_WIDTH;
extern const int SCREEN_HEIGHT;
extern const int SQUARE_SIZE;

extern SDL_Texture* platformTexture;
extern SDL_Texture* visitedPlatformTexture;

const int PLATFORM_WIDTH = 100;
const int PLATFORM_HEIGHT = 20;
const int PLATFORM_SPACING = 90; // Odległość między platformami w pionie
const int MAX_PLATFORMS = 15; // Maksymalna liczba platform na ekranie
const int MAX_HORIZONTAL_DISTANCE = 200; // Maksymalna odległość w poziomie między platformami

std::vector<Platform> platforms;

void initPlatforms(SDL_Renderer* renderer) {
    std::string platformTexturePath = getResourcePath("platform.jpg");
    platformTexture = IMG_LoadTexture(renderer, platformTexturePath.c_str());
    if (!platformTexture) {
        std::cerr << "Failed to load platform texture: " << platformTexturePath << " " << IMG_GetError() << std::endl;
        return;
    }

    std::string visitedPlatformTexturePath = getResourcePath("visited_platform.jpg");
    visitedPlatformTexture = IMG_LoadTexture(renderer, visitedPlatformTexturePath.c_str());
    if (!visitedPlatformTexture) {
        std::cerr << "Failed to load visited platform texture: " << visitedPlatformTexturePath << " " << IMG_GetError() << std::endl;
        return;
    }

    // Dwie początkowe platformy
    platforms.push_back({SCREEN_WIDTH / 2 - PLATFORM_WIDTH / 2, SCREEN_HEIGHT - SQUARE_SIZE - PLATFORM_HEIGHT, PLATFORM_WIDTH, PLATFORM_HEIGHT, false, platformTexture, visitedPlatformTexture});
    platforms.push_back({SCREEN_WIDTH / 3 - PLATFORM_WIDTH / 2, SCREEN_HEIGHT - 3 * SQUARE_SIZE - PLATFORM_HEIGHT, PLATFORM_WIDTH, PLATFORM_HEIGHT, false, platformTexture, visitedPlatformTexture});
}

void generatePlatform(int minY) {
    int x, y;
    bool validPosition = false;

    while (!validPosition) {
        x = rand() % (SCREEN_WIDTH - PLATFORM_WIDTH);
        y = minY - PLATFORM_SPACING;

        // Sprawdź odległość od ostatniej platformy na x
        Platform lastPlatform = platforms.back();
        int distanceX = abs(lastPlatform.x - x);
        validPosition = distanceX <= MAX_HORIZONTAL_DISTANCE;
    }

    platforms.push_back({x, y, PLATFORM_WIDTH, PLATFORM_HEIGHT, false, platformTexture, visitedPlatformTexture});
}


bool checkCollision(int squareX, int squareY, int squareSize, Platform platform) {
    return squareX < platform.x + platform.width &&
           squareX + squareSize > platform.x &&
           squareY < platform.y + platform.height &&
           squareY + squareSize > platform.y;
}
