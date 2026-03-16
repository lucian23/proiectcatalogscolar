# 📚 Catalog Școlar Online

Sistem modern de management școlar construit cu Laravel 12 și Tailwind CSS.

![Laravel](https://img.shields.io/badge/Laravel-12-red?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.3+-blue?style=flat-square&logo=php)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.4-38bdf8?style=flat-square&logo=tailwindcss)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

## 🎯 Descriere

Catalog Școlar Online este o aplicație web pentru gestionarea activităților școlare, dezvoltată special pentru școlile din România. Permite profesorilor și administrației să gestioneze notele, elevii, clasele și materiile într-un mod eficient și modern.

## ✨ Funcționalități

### Gestionare Elevi
- Înscriere și administrare elevi
- Căutare și filtrare după clasă
- Fișă detaliată cu situația școlară
- Raport complet pentru fiecare elev

### Gestionare Clase
- Creare și editare clase (nume, an, profil)
- Vizualizare elevi din clasă
- Statistici pe clasă (medie, promovabilitate)

### Gestionare Profesori
- Adăugare profesori cu grade didactice
- Atribuire materii predate
- Istoric note acordate

### Gestionare Materii
- Materii obligatorii și opționale
- Cod și descriere pentru fiecare materie

### Sistem de Note
- Adăugare note curente și teze
- Calcul automat al mediilor
- Istoric note pe elev și materie

### Rapoarte
- Situație generală pe clase
- Raport complet pentru fiecare elev
- Statistici de promovabilitate
- Export pentru tipărire

### Interfață Modernă
- Design responsive (desktop și mobil)
- Temă curată cu Tailwind CSS
- Navigare intuitivă
- Mesaje de confirmare și eroare

## 📋 Cerințe Sistem

- PHP >= 8.2
- Composer
- Node.js >= 18
- SQLite sau MySQL
- Laragon / XAMPP / Valet (pentru development local)

## 🚀 Instalare

### 1. Clonează repository-ul

```bash
git clone https://github.com/lucian23/proiectcatalogscolar.git
cd proiectcatalogscolar
```

### 2. Instalează dependențele PHP

```bash
composer install
```

### 3. Instalează dependențele Node.js

```bash
npm install
```

### 4. Configurează mediul

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configurează baza de date

Editează `.env` pentru baza de date:

```env
# Pentru SQLite (implicit)
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

# Sau pentru MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=catalog_scolar
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Rulează migrările și seed-urile

```bash
php artisan migrate --seed
```

### 7. Pornește serverul de development

```bash
php artisan serve
```

Accesează aplicația la: `http://localhost:8000`

## 👤 Credențiale Demo

După ce rulezi seed-urile, poți accesa aplicația cu:

- **Email:** `admin@scoala.ro`
- **Parolă:** `password`

## 📸 Screenshots

### Dashboard
![Dashboard](docs/screenshots/dashboard.png)

### Lista Elevi
![Elevi](docs/screenshots/elevi.png)

### Fișă Elev
![Fisa Elev](docs/screenshots/fisa-elev.png)

### Raport Clase
![Rapoarte](docs/screenshots/rapoarte.png)

## 🏗️ Structura Proiectului

```
catalog-scolar/
├── app/
│   ├── Http/Controllers/    # Controllerele aplicației
│   ├── Models/               # Modelele Eloquent
│   └── ...
├── database/
│   ├── migrations/           # Migrările bazei de date
│   └── seeders/              # Seed-uri pentru date demo
├── resources/
│   └── views/                # Blade templates
├── routes/
│   └── web.php               # Rutele aplicației
└── ...
```

## 🔧 Tehnologii Folosite

- **Backend:** Laravel 12, PHP 8.3
- **Frontend:** Tailwind CSS 3.4, Blade Templates
- **Database:** SQLite / MySQL
- **Icons:** Font Awesome 6

## 📝 Licență

Acest proiect este open-source sub licența [MIT License](LICENSE).

## 🤝 Contribuții

Contribuțiile sunt binevenite! Te rog să:

1. Fork proiectul
2. Creează un branch pentru feature (`git checkout -b feature/AmazingFeature`)
3. Commit schimbările (`git commit -m 'Add some AmazingFeature'`)
4. Push la branch (`git push origin feature/AmazingFeature`)
5. Deschide un Pull Request

## 📧 Contact

Pentru întrebări sau sugestii, deschide un [Issue](https://github.com/lucian23/proiectcatalogscolar/issues).

---

Dezvoltat cu ❤️ pentru școlile din România