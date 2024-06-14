
# LaravelGram 📸

Welcome to **LaravelGram**, a social media platform built with Laravel, where users can share and interact with photos. This project aims to provide a seamless and engaging experience similar to popular photo-sharing platforms.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
  - [Pull Requests](#pull-requests)
  - [Todos](#todos)
- [Contact](#contact)

## Features

- 📷 Share photos
- ❤️ Like and comment on posts
- 📝 User profiles and activity feed
- 🔒 Secure authentication and authorization
- 🌐 Responsive design
- 📊 Image upload progress bar
- 👥 User follow functionality

## Installation

### Prerequisites

- PHP 8.0 or higher
- Composer
- Node.js and npm

### Steps

1. Clone the repository

   ```bash
   git clone https://github.com/amirali-pishdadi/LaravelGram.git
   cd LaravelGram
   ```

2. Install dependencies

   ```bash
   composer install
   npm install
   ```

3. Copy the `.env` file and generate an application key

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure the `.env` file with your database and other settings.

5. Run migrations and seed the database

   ```bash
   php artisan migrate --seed
   ```

6. Start the development server

   ```bash
   php artisan serve
   ```

7. Compile the assets

   ```bash
   npm run dev
   ```

## Usage

Open your browser and navigate to `http://localhost:8000` to start using LaravelGram.

## Contributing

We welcome contributions from the community! Please read the following guidelines before contributing.

### Pull Requests

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/YourFeature`).
3. Commit your changes (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature/YourFeature`).
5. Open a pull request.

### Todos

Here are some tasks and features that we would love to see added to LaravelGram. Feel free to pick any of these todos and contribute to the project!

- **User Experience Improvements**
  - [ ] Improve the UI/UX for mobile devices 📱
  - [ ] Add dark mode 🌙
  - [ ] Implement infinite scrolling for the feed 📜

- **Notification System**
  - [ ] Implement notifications for likes and comments 🔔
  - [ ] Add email notifications for new followers and comments 📧
  - [ ] Implement real-time notifications using WebSockets 🕒

- **Performance Enhancements**
  - [ ] Optimize database queries for better performance ⚡
  - [ ] Add caching for frequently accessed data 🗄️
  - [ ] Improve image loading speeds by using lazy loading 💤

- **Security and Authentication**
  - [ ] Implement two-factor authentication (2FA) 🔐
  - [ ] Enhance password reset process 🔑
  - [ ] Add CAPTCHA to the registration and login forms 🛡️

- **New Features**
  - [ ] Add a direct messaging system 📨
  - [ ] Implement story feature similar to Instagram 📚
  - [ ] Add a search functionality to find users and posts 🔍

- **Developer Tools**
  - [ ] Improve documentation 📚
  - [ ] Add more unit and feature tests 🧪
  - [ ] Create a Docker setup for easier development 🐳

## Contact

Have questions or suggestions? Feel free to contact us at [amirpishdadi4@gmail.com](mailto:amirpishdadi4@gmail.com) or open an issue.

---

Happy coding! 🎉
