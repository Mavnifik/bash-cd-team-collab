<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Emotion Recognition</title>
    <link rel="stylesheet" href="index.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Include Chart.js -->
</head>
<body>
    <header>
        <a href="index.php" style="text-decoration: none; color: inherit;">
            <h1>Music Emotion Recognition System</h1>
        </a>
        <p>Analyze the emotional essence of your favorite songs!</p>
        <!-- Login Button -->
        <a href="login.php">
            <button class="login-button">Login</button>
        </a>
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
                <div class="album_container">
                    <div class="album_cover">
                        <img src="resources/images/shape.png" alt="Shape of You Album Cover">
                    </div>
                    <div class="album">
                        <div class="album_title">Shape of You</div>
                        <div class="album_singer">Ed Sheeran</div>
                    </div>
                </div>
                <div class="album_container">
                    <div class="album_cover">
                        <img src="resources/images/blindinglights.png" alt="Blinding Lights Album Cover">
                    </div>
                    <div class="album">
                        <div class="album_title">Blinding Lights</div>
                        <div class="album_singer">The Weeknd</div>
                    </div>
                </div>
                <div class="album_container">
                    <div class="album_cover">
                        <img src="resources/images/intheend.png" alt="In The End Album Cover">
                    </div>
                    <div class="album">
                        <div class="album_title">In The End</div>
                        <div class="album_singer">Linkin Park</div>
                    </div>
                </div>
                <div class="album_container">
                    <div class="album_cover">
                        <img src="resources/images/theclimb.png" alt="The Climb Album Cover">
                    </div>
                    <div class="album">
                        <div class="album_title">The Climb</div>
                        <div class="album_singer">Miley Cyrus</div>
                    </div>
                </div>
            </div>

            <!-- Second Column: Song Analysis -->
            <div class="song-analysis">
                <div class="input-section">
                    <label for="song-url">Enter Song URL:</label>
                    <input type="text" id="song-url" placeholder="e.g., https://www.youtube.com/watch?v=mWRsgZuwf_8">
                    <button id="analyzeButton">Analyze</button>
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
                            <li id="tempo">Tempo: 90 BPM</li>
                            <li id="key">Key: B Minor</li>
                            <li id="energy">Energy: 62%</li>
                        </ul>
                    </div>
                    <p><strong>Accuracy:</strong> <span id="accuracy">90%</span></p> <!-- Accuracy section -->
                </div>
                <div id="lyrics-section" style="display: none;">
                    <p><strong>Lyrics</strong></p>
                    <div id="lyrics-content">
                        <!-- Lyrics will be dynamically inserted here -->
                    </div>
                </div>                

                <!-- Emotion Chart Section -->
                <div class="emotion-chart-container">
                    <div class="emotion-chart">
                        <canvas id="emotionGraph"></canvas> <!-- Canvas for the radar chart -->
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>© 2024 Music Emotion Recognition System</p>
    </footer>

    <script>
        document.getElementById('analyzeButton').addEventListener('click', function() {
            const songUrl = document.getElementById('song-url').value.trim();
            const resultSection = document.getElementById('result-section');
            const lyricsSection = document.getElementById('lyrics-section');
            const lyricsContent = document.getElementById('lyrics-content');
            
            // Example data for predefined URLs
            const songData = {
                "https://www.youtube.com/watch?v=hLQl3WQQoQ0": {
                    title: "Someone Like You",
                    singer: "Adele",
                    emotion: "Sad",
                    description: "This song conveys deep emotional longing and loss, enhanced by its heartfelt lyrics and melancholic melody.",
                    audioFeatures: ["Tempo: 68 BPM", "Key: A Major", "Energy: 50%"],
                    albumCover: "resources/images/someonelikeyou.png",
                    lyrics: `I heard that you're settled down,  
                             That you found a girl and you're married now...`,
                    emotionScores: {
                        happiness: 10,
                        sadness: 80,
                        anger: 5,
                        calmness: 50
                    },
                    accuracy: 90,
                    tempo: 68,
                    key: "A Major",
                    energy: 50
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
                             Are all made of gold...`,
                    emotionScores: {
                        happiness: 20,
                        sadness: 70,
                        anger: 40,
                        calmness: 60
                    },
                    accuracy: 85,
                    tempo: 90,
                    key: "B Minor",
                    energy: 62
                },
                "https://www.youtube.com/watch?v=JGwWNGJdvx8": {
                    title: "Shape of You",
                    singer: "Ed Sheeran",
                    emotion: "Happy",
                    description: "This upbeat song is perfect for dancing and feeling energized. The lyrics are playful, and the rhythm adds to the joyful atmosphere.",
                    audioFeatures: ["Tempo: 96 BPM", "Key: C# Minor", "Energy: 85%"],
                    albumCover: "resources/images/shape.png",
                    lyrics: `The club isn't the best place to find a lover,  
                             So the bar is where I go...`,
                    emotionScores: {
                        happiness: 90,
                        sadness: 10,
                        anger: 5,
                        calmness: 30
                    },
                    accuracy: 95,
                    tempo: 96,
                    key: "C# Minor",
                    energy: 85
                },
                "https://www.youtube.com/watch?v=4NRXx6U8ABQ": {
                    title: "Blinding Lights",
                    singer: "The Weeknd",
                    emotion: "Happy",
                    description: "A song with an 80s vibe that blends retro sounds with a modern twist. It's energetic, with themes of longing and love.",
                    audioFeatures: ["Tempo: 85 BPM", "Key: F Minor", "Energy: 78%"],
                    albumCover: "resources/images/blindinglights.png",
                    lyrics: `I've been tryna call,  
                             I've been on my own for long enough...`,
                    emotionScores: {
                        happiness: 85,
                        sadness: 15,
                        anger: 10,
                        calmness: 40
                    },
                    accuracy: 92,
                    tempo: 85,
                    key: "F Minor",
                    energy: 78
                },
                "https://www.youtube.com/watch?v=eVTXPUF4Oz4": {
                    title: "In the End",
                    singer: "Linkin Park",
                    emotion: "Anger",
                    description: "A powerful rock anthem dealing with frustration and defeat, with intense vocals and aggressive instrumentals that convey anger.",
                    audioFeatures: ["Tempo: 105 BPM", "Key: C Minor", "Energy: 90%"],
                    albumCover: "resources/images/intheend.png",
                    lyrics: `I tried so hard and got so far,  
                             But in the end, it doesn't even matter...`,
                    emotionScores: {
                        happiness: 15,
                        sadness: 30,
                        anger: 80,
                        calmness: 20
                    },
                    accuracy: 93,
                    tempo: 105,
                    key: "C Minor",
                    energy: 90
                },
                "https://www.youtube.com/watch?v=NG2zyeVRcbs": {
                    title: "The Climb",
                    singer: "Miley Cyrus",
                    emotion: "Calm",
                    description: "An inspiring song about resilience and overcoming challenges, with a calm melody and uplifting lyrics.",
                    audioFeatures: ["Tempo: 80 BPM", "Key: C Major", "Energy: 60%"],
                    albumCover: "resources/images/theclimb.png",
                    lyrics: `I can almost see it,  
                             That dream I'm dreaming,  
                             But there's a voice inside my head saying...`,
                    emotionScores: {
                        happiness: 40,
                        sadness: 20,
                        anger: 10,
                        calmness: 80
                    },
                    accuracy: 88,
                    tempo: 80,
                    key: "C Major",
                    energy: 60
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
                document.getElementById("tempo").textContent = `Tempo: ${song.tempo} BPM`;
                document.getElementById("key").textContent = `Key: ${song.key}`;
                document.getElementById("energy").textContent = `Energy: ${song.energy}%`;

                // Update accuracy
                document.getElementById("accuracy").textContent = `${song.accuracy}%`;

                // Update lyrics
                lyricsContent.innerHTML = `<p>${song.lyrics.replace(/\n/g, "<br>")}</p>`;

                // Update emotion chart
                updateEmotionChart(song.emotionScores, song.accuracy);

                // Display sections
                resultSection.style.display = "block";
                lyricsSection.style.display = "block";
            } else {
                alert("Song data not available for this URL.");
                resultSection.style.display = "none";
                lyricsSection.style.display = "none";
            }
        });

        function updateEmotionChart(emotionScores, accuracy) {
            const ctx = document.getElementById('emotionGraph').getContext('2d');

            // Ensure that we have valid emotionScores
            if (!emotionScores || typeof emotionScores !== 'object') {
                alert("Invalid emotion scores");
                return;
            }

            // Prepare data for the chart
            const data = {
                labels: ['Happiness', 'Sadness', 'Anger', 'Calmness'],
                datasets: [{
                    label: 'Emotion Analysis',
                    data: [
                        emotionScores.happiness || 0,
                        emotionScores.sadness || 0,
                        emotionScores.anger || 0,
                        emotionScores.calmness || 0
                    ],
                    backgroundColor: 'rgba(29, 185, 84, 0.5)', // Adjust color for better visibility
                    borderColor: '#1DB954',
                    borderWidth: 2,
                    pointBackgroundColor: '#1DB954',
                }]
            };

            // Define chart options for better appearance
            const options = {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#e0e0e0'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#181818',
                        titleColor: '#1DB954',
                        bodyColor: '#e0e0e0',
                        borderColor: '#1DB954',
                        borderWidth: 1
                    },
                    title: {
                        display: true,
                        text: `Accuracy: ${accuracy}%`, // Displaying accuracy as the title
                        color: '#1DB954'
                    }
                },
                scales: {
                    r: {
                        grid: {
                            color: '#333'
                        },
                        angleLines: {
                            color: '#555'
                        },
                        ticks: {
                            color: '#e0e0e0',
                            backdropColor: '#121212'
                        },
                        pointLabels: {
                            color: '#e0e0e0'
                        }
                    }
                }
            };

            // Create the radar chart
            new Chart(ctx, {
                type: 'radar',
                data: data,
                options: options
            });
        }

    </script>
</body>
</html>
