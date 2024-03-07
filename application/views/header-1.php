<style>
    @import url("https://fonts.googleapis.com/css?family=Montserrat");

    /* body {
        margin: 0;
        display: flex;
        height: 100vh;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
        font: 62.5% "Montserrat", sans-serif;
        background-color: #201c29;
        background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAjCAQAAAC00HvSAAAAqUlEQVR4AaXTIa7EMBBEwfrSAAODwAUfGBiY5P7H26XDIqXfAUrpseI520fcAf+itgEqgW4TMugoCKA2J4DanAQ6CgKozYmg44IMuhVk0FaQQceEDLoNyKBtQAZtExKozQkot7Dv37e42rqoaUk6Koe21ngJLYMManN6034xJzz2UnqvvugY+fNvIIOWIoW24aHnG20V/yJtTgAtAyKozQmgpURdLp+nOT9tfAyifaRWFwAAAABJRU5ErkJggg==);
    }

    h1 {
        transform: rotate(180deg);
        text-transform: uppercase;
        text-align: center;
        font-size: 2rem;
        writing-mode: vertical-rl;
        color: #ab49de;
        background-image: linear-gradient(-90deg, #ab49de, #180622);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        user-select: none;
    } */

    .bar {
        margin: 0;
        padding: 1em;
        display: flex;
        min-width: 380px;
        height: 100px;
        justify-content: right;
        align-items: center;
    }

    .bar li {
        position: relative;
        list-style: none;
        border-radius: 1em;
    }

    .bar li::before,
    .bar li::after {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        z-index: -1;
        content: "";
        width: 0%;
        height: 2px;
        background-color: #9525cf;
        transition: all 0.5s cubic-bezier(0.4, -1, 0.2, -1);
    }

    .bar li:before {
        top: 0;
        border-top-right-radius: 0.5em;
        border-top-left-radius: 0.5em;
    }

    .bar li::after {
        bottom: 0;
        border-bottom-right-radius: 0.5em;
        border-bottom-left-radius: 0.5em;
    }

    .bar li:hover::before,
    .bar li:hover::after {
        width: 25%;
        height: 3px;
    }

    .bar li a {
        text-decoration: none;
        text-transform: uppercase;
        display: block;
        padding: 0.5em 2em;
        font-size: 1rem;
        font-weight: 700;
        color: #d39fee;
    }

    .bar li.active {
        border-color: #370e4d;
    }

    .bar li.active::before,
    .bar li.active::after {
        width: 100%;
        height: 50%;
    }
</style>

<ul class="bar">
    <li><a href="<?php echo base_url(); ?>" title="Click me">Home</a>
    </li>
    <li><a href="#" title="Click me">About</a>
    </li>
    <li><a href="<?php echo base_url() ?>/conact-us" title="Click me">Contact</a>
    </li>
    <!-- <li><a href="#" title="Click me">Link</a> -->
    </li>
</ul>

<script>
    let bar = Array.from(document.querySelectorAll("li"));

    bar.forEach(function(it) {
        it.onclick = function() {
            bar.forEach(function(el) {
                el.classList.remove("active");
            });
            this.classList.toggle("active");
        };
    });
</script>