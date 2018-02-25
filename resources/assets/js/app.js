require("./bootstrap")

const video = document.querySelector(".video")

if (video) {
    const waveform = document.querySelector(".waveform")
    const tracker = document.querySelector(".tracker")
    const rewind = document.querySelector(".rewind")
    const play = document.querySelector(".play")
    const slides = document.querySelectorAll(".slide")

    const track = waveform.getAttribute("data-track")
    const seconds = waveform.getAttribute("data-seconds")

    const audio = new Audio(track)

    let playing = false

    rewind.className = rewind.className
        .split(" ")
        .filter(c => c !== "d-none")
        .join(" ")

    play.className = play.className
        .split(" ")
        .filter(c => c !== "d-none")
        .join(" ")

    audio.addEventListener("play", e => {
        playing = true
    })

    audio.addEventListener("pause", e => {
        playing = false
    })

    audio.addEventListener("ended", e => {
        play.innerText = "play"
        audio.currentTime = 0
        tracker.style.left = 0
        playing = false
    })

    waveform.addEventListener("click", e => {
        const rect = waveform.getBoundingClientRect()
        const fraction = (e.clientX - rect.left) / rect.width

        const time = Math.round(fraction * seconds)

        audio.currentTime = time
        tracker.style.left = fraction * 100 + "%"
    })

    play.addEventListener("click", e => {
        if (playing) {
            audio.pause()
            play.innerText = "play"
        } else {
            audio.play()
            play.innerText = "pause"
        }
    })

    rewind.addEventListener("click", e => {
        audio.currentTime = 0
        tracker.style.left = 0
    })

    setInterval(() => {
        if (playing) {
            const fraction = audio.currentTime / seconds
            tracker.style.left = fraction * 100 + "%"
        }
    }, 250)

    slides.forEach(slide => {
        const dataId = slide.getAttribute("data-id")
        const dataWords = slide.getAttribute("data-words")
        const dataWidth = slide.getAttribute("data-width")
        const dataHeight = slide.getAttribute("data-height")
        const dataPadding = slide.getAttribute("data-padding")
        const dataFade = slide.getAttribute("data-fade")

        const width = video.offsetWidth

        const tileWidth = width / 4 - 20
        const tileHeight = tileWidth / 16 * 9

        const link = document.createElement("a")

        const tile = new PIXI.Application(tileWidth, tileHeight, {
            backgroundColor: 0xffffff,
            antialias: true,
        })

        let size = 36

        let style = new PIXI.TextStyle({
            fontFamily: "Arial",
            fontSize: size,
            fill: "#000000",
            wordWrap: false,
            align: "center",
        })

        const padding = tileWidth / dataWidth * dataPadding

        const allowedWidth = tileWidth - padding
        const allowedHeight = tileHeight - padding

        let metrics = PIXI.TextMetrics.measureText(dataWords, style)

        while (metrics.width > allowedWidth || metrics.height > allowedHeight) {
            size -= 1

            style = new PIXI.TextStyle({
                fontFamily: "Arial",
                fontSize: size,
                fill: "#000000",
                wordWrap: false,
                align: "center",
            })

            metrics = PIXI.TextMetrics.measureText(dataWords, style)
        }

        const words = new PIXI.Text(dataWords, style)

        words.x = (tileWidth - metrics.width) / 2
        words.y = (tileHeight - metrics.height) / 2

        tile.stage.addChild(words)

        while (slide.firstChild) {
            slide.removeChild(slide.firstChild)
        }

        link.appendChild(tile.view)
        slide.appendChild(link)
    })
}
