-- Create the database
CREATE DATABASE IF NOT EXISTS MeandYou;
USE MeandYou;

-- Create the users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the music table
CREATE TABLE music (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    artist VARCHAR(255) NOT NULL,
    album VARCHAR(255),
    genre VARCHAR(50),
    release_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the playlists table
CREATE TABLE playlists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Create the playlist_music table (many-to-many relationship)
CREATE TABLE playlist_music (
    id INT AUTO_INCREMENT PRIMARY KEY,
    playlist_id INT NOT NULL,
    music_id INT NOT NULL,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (playlist_id) REFERENCES playlists(id) ON DELETE CASCADE,
    FOREIGN KEY (music_id) REFERENCES music(id) ON DELETE CASCADE
);

-- Insert sample data into the music table
INSERT INTO music (title, artist, album, genre, release_date) VALUES
('Song 1', 'Artist 1', 'Album 1', 'Pop', '2023-01-01'),
('Song 2', 'Artist 2', 'Album 2', 'Rock', '2023-02-01'),
('Song 3', 'Artist 3', 'Album 3', 'Jazz', '2023-03-01'),
('Song 4', 'Artist 4', 'Album 4', 'Hip-Hop', '2023-04-01'),
('Song 5', 'Artist 5', 'Album 5', 'Classical', '2023-05-01'),
('Bohemian Rhapsody', 'Queen', 'A Night at the Opera', 'Rock', '1975-10-31'),
('Billie Jean', 'Michael Jackson', 'Thriller', 'Pop', '1983-01-02'),
('Shape of You', 'Ed Sheeran', '÷', 'Pop', '2017-01-06'),
('Imagine', 'John Lennon', 'Imagine', 'Rock', '1971-10-11'),
('Sweet Child O Mine', 'Guns N Roses', 'Appetite for Destruction', 'Rock', '1987-08-17');