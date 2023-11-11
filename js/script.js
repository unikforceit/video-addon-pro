$(document).ready(function() {
    let hoveredVideo = null;

    function playRandomSegment(videoElement) {
        const videoDuration = videoElement.duration;
        const randomStart = Math.random() * (videoDuration - 15);
        videoElement.currentTime = randomStart;
        videoElement.play();
    }

    function captureThumbnail(videoElement, thumbnailElement) {
        const canvas = document.createElement("canvas");
        canvas.width = videoElement.videoWidth;
        canvas.height = videoElement.videoHeight;
        const ctx = canvas.getContext("2d");
        ctx.drawImage(videoElement, 0, 0, canvas.width, canvas.height);
        thumbnailElement.src = canvas.toDataURL();
    }

    // Set a random thumbnail for each video
    $(".video-thumbnail").each(function() {
        const video = $(this)[0];
        const thumbnail = $(this).next('.thumbnail')[0];
        video.addEventListener("loadedmetadata", function() {
            // playRandomSegment(video);
            setTimeout(() => {
                captureThumbnail(video, thumbnail);
                video.currentTime = 0;
                video.pause();
            }, 1000);
        });
    });

    $(".video-thumbnail").hover(function() {
        if (hoveredVideo) {
            hoveredVideo.pause();
            hoveredVideo.currentTime = 0;
        }

        hoveredVideo = this;
        playRandomSegment(hoveredVideo);
    }, function() {
        if (hoveredVideo) {
            hoveredVideo.pause();
            hoveredVideo.currentTime = 0;
        }
    });
    $(".popup").hide();
    $(".video").click(function() {
        var video = $(this).find("video")[0];
        if (hoveredVideo) {
            hoveredVideo.pause();
            hoveredVideo.currentTime = 0;
        }
        var videoSrc = $(this).find("video").attr("src");
        $(".popup-video").attr("src", videoSrc);
        $(".popup").show();
    });

    $(".close-button").click(function() {
        $(".popup-video").attr("src", "");
        $(".popup").hide();
    });
});
