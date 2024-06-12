#include <SDL.h>
#include <SDL_image.h>
#include <SDL_ttf.h>
#include <vector>
#include <string>
#include "platform.h"
#include "texture.h"
#include "score.h"

// Stałe dla rozmiaru okna
const int SCREEN_WIDTH = 640;
const int SCREEN_HEIGHT = 480;
const int SQUARE_SIZE = 50; // Rozmiar postaci bo jest kwadratowa
const int GRAVITY = 1;
const int JUMP_STRENGTH = 15;
const float MOVE_SPEED = 0.5f;
const int MAX_FALL_SPEED = 15;
const float FRICTION = 0.9f; // Stała tarcia
const float SLOWDOWN = 0.98f; // Współczynnik zmniejszający prędkość podczas tarcia... inaczej mi za szybko latała postać

// Tekstury postaci, platform, czcionki
SDL_Texture* playerTexture;
SDL_Texture* platformTexture;
SDL_Texture* visitedPlatformTexture;
TTF_Font* font;
SDL_Color textColor = {255, 255, 255, 255};

int main(int argc, char* argv[]) {
    // Inicjalizacje
    // Inicjalizacja SDL
    if (SDL_Init(SDL_INIT_VIDEO) < 0) {
        SDL_Log("Nie udało się zainicjować SDL: %s", SDL_GetError());
        return 1;
    }

    // Inicjalizacja SDL_image
    if (!(IMG_Init(IMG_INIT_PNG | IMG_INIT_JPG) & (IMG_INIT_PNG | IMG_INIT_JPG))) {
        SDL_Log("Nie udało się zainicjować SDL_image: %s", IMG_GetError());
        SDL_Quit();
        return 1;
    }

    // Inicjalizacja SDL_ttf
    if (TTF_Init() == -1) {
        SDL_Log("Nie udało się zainicjować SDL_ttf: %s", TTF_GetError());
        IMG_Quit();
        SDL_Quit();
        return 1;
    }

    // Stworzenie okna
    SDL_Window* window = SDL_CreateWindow("Prosta Gra 2D", SDL_WINDOWPOS_CENTERED, SDL_WINDOWPOS_CENTERED, SCREEN_WIDTH, SCREEN_HEIGHT, SDL_WINDOW_SHOWN);
    if (!window) {
        SDL_Log("Nie udało się stworzyć okna: %s", SDL_GetError());
        TTF_Quit();
        IMG_Quit();
        SDL_Quit();
        return 1;
    }

    // Stworzenie renderera
    SDL_Renderer* renderer = SDL_CreateRenderer(window, -1, SDL_RENDERER_ACCELERATED);
    if (!renderer) {
        SDL_Log("Nie udało się stworzyć renderer'a: %s", SDL_GetError());
        SDL_DestroyWindow(window);
        TTF_Quit();
        IMG_Quit();
        SDL_Quit();
        return 1;
    }

    // Załaduj tekstury
    playerTexture = loadTexture(renderer, "player.jpg");
    platformTexture = loadTexture(renderer, "platform.jpg");
    visitedPlatformTexture = loadTexture(renderer, "visited_platform.jpg");
    if (!playerTexture || !platformTexture || !visitedPlatformTexture) {
        cleanup(renderer, window);
        return 1;
    }

    // Załaduj czcionkę
    font = TTF_OpenFont("/System/Library/Fonts/Supplemental/Arial.ttf", 24);
    if (!font) {
        SDL_Log("Failed to load font: %s", TTF_GetError());
        cleanup(renderer, window);
        return 1;
    }

    // Inicjalizacja platform... funkcja zadeklarowana w platform.cpp
    initPlatforms(renderer);

    // Początkowe zmienne
    // Pozycja postaci... czyli naszego kwadratu
    int squareX = SCREEN_WIDTH / 2 - SQUARE_SIZE / 2;
    int squareY = SCREEN_HEIGHT - SQUARE_SIZE - PLATFORM_HEIGHT;
    int velocityY = 0;
    float velocityX = 0.0f;
    bool movingLeft = false;
    bool movingRight = false;
    bool isJumping = false;
    int score = 0;
    int highScore = 0;
    int cameraY = 0;

    // Pętla główna
    bool quit = false;
    while (!quit) {
        // Obsługa zdarzeń
        SDL_Event event;
        while (SDL_PollEvent(&event)) {
            if (event.type == SDL_QUIT) { // jak wychodzimy
                quit = true;
            } else if (event.type == SDL_KEYDOWN) { // jak klikamy klawisz
                switch (event.key.keysym.sym) {
                    case SDLK_LEFT:
                        movingLeft = true;
                        break;
                    case SDLK_RIGHT:
                        movingRight = true;
                        break;
                    case SDLK_SPACE:
                        if (!isJumping) {
                            velocityY = -JUMP_STRENGTH;
                            isJumping = true;
                        }
                        break;
                    default:
                        break;
                }
            } else if (event.type == SDL_KEYUP) { // jak zwalniamy klawisz
                switch (event.key.keysym.sym) {
                    case SDLK_LEFT:
                        movingLeft = false;
                        break;
                    case SDLK_RIGHT:
                        movingRight = false;
                        break;
                    default:
                        break;
                }
            }
        }

        // Aktualizacja zmiennej prędkości poziomej... czyli na jaką strone +/- nastawić zmienną
        if (movingLeft) {
            velocityX -= MOVE_SPEED;
        }
        if (movingRight) {
            velocityX += MOVE_SPEED;
        }
        if (!movingLeft && !movingRight) {
            velocityX *= FRICTION; // Zastosowanie tarcia... zmniejszamy predkość postaci
            if (velocityX < 0.01f && velocityX > -0.01f) {
                velocityX = 0; // Zatrzymanie postaci, gdy prędkość jest bardzo mała
            }
        }
        velocityX *= SLOWDOWN; // Dodatkowe spowolnienie prędkości... bo bez tego mi za mocno latała

        // Aktualizacja pozycji... czyli tutaj rzeczywiście sie ruszamy... musimy konwertowac float na int
        squareX += static_cast<int>(velocityX);

        // Zatrzymaj postać jak dojdzie do lewej/prawej krawędzi
        if (squareX < 0) {
            squareX = 0;
            velocityX = 0;
        } else if (squareX + SQUARE_SIZE > SCREEN_WIDTH) {
            squareX = SCREEN_WIDTH - SQUARE_SIZE;
            velocityX = 0;
        }

        // Grawitacja
        velocityY += GRAVITY; // dodatnia wartość velocityY oznacza ruch w dół... dltego grawitacja +1 nam przyśpiesza
        if (velocityY > MAX_FALL_SPEED) {
            velocityY = MAX_FALL_SPEED;
        }
        squareY += velocityY;

        // Detekcja kolizji z platformami
        for (auto& platform : platforms) { // Iteruje przez wszystkie platformy w wektorze

            if (velocityY > 0 && checkCollision(squareX, squareY+20, SQUARE_SIZE, platform)) {
                if(!platform.isVisited) {
                    platform.x += rand() % 25;
                }
            }

            if (velocityY > 0 && checkCollision(squareX, squareY, SQUARE_SIZE, platform)) { // w platform.cpp ta func
                squareY = platform.y - SQUARE_SIZE;
                velocityY = 0;
                isJumping = false;
                if (!platform.isVisited) {
                    platform.isVisited = true;
                    score++;
                    if (score > highScore) {
                        highScore = score;
                    }
                }
            }
        }


        // Sprawdź, czy gracz spadł poza ekran
        if (squareY + SQUARE_SIZE > SCREEN_HEIGHT + cameraY) {
            // Powrót do początkowej pozycji
            squareX = SCREEN_WIDTH / 2 - SQUARE_SIZE / 2;
            squareY = SCREEN_HEIGHT - SQUARE_SIZE - PLATFORM_HEIGHT;
            cameraY = 0;
            velocityY = 0;
            score = 0;

            // Zresetuj platformy
            platforms.clear();
            initPlatforms(renderer);
        }

        // Aktualizacja kamery
        if (squareY < cameraY + SCREEN_HEIGHT / 2) {
            cameraY = squareY - SCREEN_HEIGHT / 2;

            // Generuj nowe platformy
            while (platforms.size() < MAX_PLATFORMS) {
                generatePlatform(platforms.back().y);
            }
        }

        // Usuń platformy, które są poza ekranem
        while (!platforms.empty() && platforms.front().y - cameraY > SCREEN_HEIGHT) {
            platforms.erase(platforms.begin());
        }

        // Wyczyść ekran
        SDL_SetRenderDrawColor(renderer, 0, 0, 0, 255);
        SDL_RenderClear(renderer);

        // Narysuj postać za pomocą tekstury
        SDL_Rect squareRect = {squareX, squareY - cameraY, SQUARE_SIZE, SQUARE_SIZE};
        SDL_RenderCopy(renderer, playerTexture, NULL, &squareRect);

        // Narysuj platformy za pomocą tekstur
        for (const auto& platform : platforms) {
            SDL_Rect platformRect = {platform.x, platform.y - cameraY, platform.width, platform.height};
            SDL_Texture* textureToUse = platform.isVisited ? platform.visitedTexture : platform.texture;
            SDL_RenderCopy(renderer, textureToUse, NULL, &platformRect);
        }

        // Renderowanie punktacji
        renderScore(renderer, font, textColor, score, highScore);

        // Wyświetl zmiany na ekranie
        SDL_RenderPresent(renderer);

        // Czekamy by nie zużywać zbyt dużo zasobów CPU
        SDL_Delay(10);
    }

    // Koniec
    cleanup(renderer, window);
    return 0;
}
