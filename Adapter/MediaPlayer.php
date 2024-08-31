<?php

interface MediaPlayer {
    public function play($audioType, $fileName);
}

interface AdvancedMediaPlayer {
    public function playVlc($fileName);
    public function playMp4($fileName);
}

class VlcPlayer implements AdvancedMediaPlayer {
    public function playVlc($fileName) {
        echo "Playing vlc file: " . $fileName;
    }

    public function playMp4($fileName) {
        // ...
    }
}

class Mp4Player implements AdvancedMediaPlayer {
    public function playMp4($fileName) {
        echo "Playing mp4 file: " . $fileName;
    }

    public function playVlc($fileName) {
        // ...
    }
}

class MediaAdapter implements MediaPlayer {
    private $advancedMusicPlayer;

    public function __construct($audioType) {
        if ($audioType == "vlc") {
            $this->advancedMusicPlayer = new VlcPlayer();
        } elseif ($audioType == "mp4") {
            $this->advancedMusicPlayer = new Mp4Player();
        }
    }

    public function play($audioType, $fileName) {
        if ($audioType == "vlc") {
            $this->advancedMusicPlayer->playVlc($fileName);
        } elseif ($audioType == "mp4") {
            $this->advancedMusicPlayer->playMp4($fileName);
        }
    }
}

class AudioPlayer implements MediaPlayer {
    private $mediaAdapter;

    public function play($audioType, $fileName) {
        if ($audioType == "mp3") {
            echo "Playing mp3 file: " . $fileName;
        } elseif ($audioType == "vlc" || $audioType == "mp4") {
            $this->mediaAdapter = new MediaAdapter($audioType);
            $this->mediaAdapter->play($audioType, $fileName);
        } else {
            echo "Invalid media type: " . $audioType;
        }
    }
    
}

$audioPlayer = new AudioPlayer();

$audioPlayer->play("mp3", "song.mp3");
echo "\n";
$audioPlayer->play("mp4", "movie.mp4");
echo "\n";
$audioPlayer->play("vlc", "video.vlc");
echo "\n";
$audioPlayer->play("avi", "film.avi");