<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Emotion Recognition</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <h1>Music Emotion Recognition System</h1>
        <p>Analyze the emotional essence of your favorite songs!</p>
    </header>

    <main>
        <div class="two-columns">
            <!-- First Column: Display-Only Song List -->
            <div class="song-list">
                <h2>Available Songs</h2>
                <div class="album_container">
                    <div class="album_cover">
                        <img src="resources/images/sddefault.jpg" alt="Demons Album Cover">
                    </div>
                    <div class="album">
                        <div class="album_title">Demons</div>
                        <div class="album_singer">Imagine Dragons</div>
                    </div>
                </div>
                <div class="album_container">
                    <div class="album_cover">
                        <img src="resources/images/shallow.png" alt="Shallow Album Cover">
                    </div>
                    <div class="album">
                        <div class="album_title">Shallow</div>
                        <div class="album_singer">Lady Gaga & Bradley Cooper</div>
                    </div>
                </div>
                <div class="album_container">
                    <div class="album_cover">
                        <img src="resources/images/someonelikeyou.png" alt="Someone Like You Album Cover">
                    </div>
                    <div class="album">
                        <div class="album_title">Someone Like You</div>
                        <div class="album_singer">Adele</div>
                    </div>
                </div>
            </div>
    
            <!-- Second Column: Song Analysis -->
            <div class="song-analysis">
                <div class="container">
                    <div class="input-section">
                        <label for="song-url">Enter Song URL:</label>
                        <input type="text" id="song-url" placeholder="e.g., https://www.youtube.com/watch?v=mWRsgZuwf_8">
                        <button onclick="analyzeSong()">Analyze</button>
                    </div>
                    <div class="result-section" id="result-section">
                        <h2>Analysis Result</h2>
                        <p><strong>Song: </strong></p>
                        <div class="album_container">
                            <div class="album_cover">
                                <img src="resources/images/sddefault.jpg" alt="Album Cover">
                            </div>
                            <div class="album">
                                <div class="album_title">Demons</div>
                                <div class="album_singer">Imagine Dragons</div>
                            </div>
                        </div>
                        <p><strong>Emotion Detected:</strong> Sad</p>
                        <p><strong>Description:</strong> The song reflects themes of personal struggle and introspection. Its melancholic tone and lyrics contribute to its classification as "Sad."</p>
                        <div class="stats">
                            <p><strong>Audio Features:</strong></p>
                            <ul>
                                <li>Tempo: 90 BPM</li>
                                <li>Key: B Minor</li>
                                <li>Energy: 62%</li>
                            </ul>
                        </div>
                    </div>
                    <div class="container" id="lyrics-section" style="display: none;">
                        <p><strong>Lyrics</strong></p>
                        <div id="lyrics-content">
                            <!-- Lyrics will be dynamically inserted here -->
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>© 2024 Music Emotion Recognition System</p>
    </footer>

    <script>
        function analyzeSong() {
            const songUrl = document.getElementById('song-url').value.trim();
            const resultSection = document.getElementById('result-section');
            const lyricsSection = document.getElementById('lyrics-section');
            const lyricsContent = document.getElementById('lyrics-content');

            // Example data for predefined URLs
            const songData = {
                "https://www.youtube.com/watch?v=UvK3e7-pDM0": {
                    title: "Someone Like You",
                    singer: "Adele",
                    emotion: "Sad",
                    description: "This song conveys deep emotional longing and loss, enhanced by its heartfelt lyrics and melancholic melody.",
                    audioFeatures: ["Tempo: 68 BPM", "Key: A Major", "Energy: 50%"],
                    albumCover: "resources/images/someonelikeyou.png",
                    lyrics: `I heard that you're settled down,  
                             That you found a girl and you're married now...`
                },
                "https://www.youtube.com/watch?v=mWRsgZuwf_8": {
                    title: "Demons",
                    singer: "Imagine Dragons",
                    emotion: "Sad",
                    description: "The song reflects themes of personal struggle and introspection. Its melancholic tone and lyrics contribute to its classification as 'Sad.'",
                    audioFeatures: ["Tempo: 90 BPM", "Key: B Minor", "Energy: 62%"],
                    albumCover: "resources/images/sddefault.jpg",
                    lyrics: `When the days are cold,  
                             And the cards all fold,  
                             And the saints we see  
                             Are all made of gold...`
                }
            };

            // Check if the song URL exists in the predefined data
            if (songData[songUrl]) {
                const song = songData[songUrl];
                resultSection.querySelector(".album_cover img").src = song.albumCover;
                resultSection.querySelector(".album_title").textContent = song.title;
                resultSection.querySelector(".album_singer").textContent = song.singer;
                resultSection.querySelector("p:nth-of-type(2)").textContent = `Emotion Detected: ${song.emotion}`;
                resultSection.querySelector("p:nth-of-type(3)").textContent = `Description: ${song.description}`;

                // Update audio features
                const statsList = resultSection.querySelector(".stats ul");
                statsList.innerHTML = song.audioFeatures.map(feature => `<li>${feature}</li>`).join("");

                // Update lyrics
                lyricsContent.innerHTML = `<p>${song.lyrics.replace(/\n/g, "<br>")}</p>`;

                // Display sections
                resultSection.style.display = "block";
                lyricsSection.style.display = "block";
            } else {
                alert("Song data not available for this URL.");
                resultSection.style.display = "none";
                lyricsSection.style.display = "none";
            }
        }
    </script>
</body>
</html>
