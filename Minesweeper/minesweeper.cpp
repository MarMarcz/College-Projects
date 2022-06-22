#include <iostream>
#include "./saper.h"

int main()
{
	try { //Mozemy zmieniac ilosc bomb jak i rozmiar planszy Ale jesli ilosc bomb > rozmiaru planszy to mamy blad
		if (ilosc_bomb >= rozmiar_pola*rozmiar_pola || ilosc_bomb < 1)
		{
			throw "Zla ilosc bomb";
		}
	} catch (...) {
		std::cout << "Zla ilosc bomb!\n";
		return 0;
	}

	std::fill(v.begin(), v.end(), ' ');
	generuj_bomby();

	short int nr_wiersza, nr_kolumny;
	char operacja;

	while (true)
	{
		system("clear");
		wyswietl_wszystkie_pola();
		std::cout << "\nOznaczenia na planszy:\n";
		std::cout << "' ' -> Pole jest nie odsloniete\n'.' -> Pole nie sasiaduje z zadna mina\n'liczba' -> Tyle bomb w okol pola\n";
		std::cout << "\nWPISZ: nr.wiersza nr.kolumny dzialanie (PO SPACJI)\n";
		std::cout << "( MOZLIWE DZIALANIA:  Z-mina  P-odsloniecie pola  F-zdjecie oznaczenia pola jako zajetego przez mine )  (Z DUZEJ LITERY)\n";
		std::cin >> nr_wiersza >> nr_kolumny >> operacja;

		while (std::cin.fail())
		{
			system("clear");
                	wyswietl_wszystkie_pola();
			std::cout << "\nOznaczenia na planszy:\n";
               		std::cout << "' ' -> Pole jest nie odsloniete\n'.' -> Pole nie sasiaduje z zadna mina\n'liczba' -> Tyle bomb w okol pola\n";
                	std::cout << "\nWPISZ: nr.wiersza nr.kolumny dzialanie (PO SPACJI)\n";
                	std::cout << "( MOZLIWE DZIALANIA:  Z-mina  P-odsloniecie pola  F-zdjecie oznaczenia pola jako zajetego przez mine )  (Z DUZEJ LITERY)\n";
			std::cin.clear();
			std::cin.ignore();
			std::cin >> nr_wiersza >> nr_kolumny >> operacja; //ewentualnie jakies czyszczenie ekranu
		}

		if (nr_wiersza > rozmiar_pola || nr_wiersza < 1 || nr_kolumny > rozmiar_pola || nr_kolumny < 1)
		{
			std::cin.clear();
			std::cin.ignore();
			std::cout << "Zle liczby!\n";
			usleep(2000000);
			continue;
		}

		akcja( ktore_pole(nr_wiersza, nr_kolumny), operacja);

		if (wygrana() == true)
		{
			system("clear");
			std::cout << "GRATULACJE, WYGRALES! :D\n";
			wyswietl_wszystkie_pola();
			exit(0);
		}
	}
return 0;
}
