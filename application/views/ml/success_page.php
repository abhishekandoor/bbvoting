<style>
.main_container {
    min-height: 75vh;
}
.btn-parent{
    font-size: 1.625em;
    color: #00ae15;
    font-weight: 600;
    display: flex;
}
.voted_msg{
    margin-left:5px;font-size: 1.2em;
    text-align:center;
}
.countdown{
    text-align:center;
}
.main_container{
    align-items:center;
}

@supports (animation: grow 1s cubic-bezier(.25, .25, .25, 1) forwards) {
    .tick {
        stroke-opacity: 0;
        stroke-dasharray: 29px;
        stroke-dashoffset: 29px;
        animation: draw 1s cubic-bezier(0.25, 0.25, 0.25, 1) forwards;
        animation-delay: 1s;
    }

    .circle {
        fill-opacity: 0;
        stroke: #219a00;
        stroke-width: 16px;
        transform-origin: center;
        transform: scale(0);
        animation: grow 1s cubic-bezier(0.25, 0.25, 0.25, 1.25) forwards;
    }
}

@keyframes grow {
    60% {
        transform: scale(0.8);
        stroke-width: 4px;
        fill-opacity: 0;
    }

    100% {
        transform: scale(0.9);
        stroke-width: 8px;
        fill-opacity: 1;
        fill: #219a00;
    }
}

@keyframes draw {

    0%,
    100% {
        stroke-opacity: 1;
    }

    100% {
        stroke-dashoffset: 0;
    }
}
@media only screen and (max-width: 767px) {
    .voted_msg{
        font-size: 1em;
        text-align:center;
    }
    .btn-parent{
        flex-direction : column;
        align-items:center;
    }
    .main_container{
        align-items:start;
    }
}
</style>

<div class="main_container d-flex justify-content-center">
    <div class="">
        <div class="btn-parent">
            <div class="svg-container">
                <svg class="ft-green-tick" xmlns="http://www.w3.org/2000/svg" height="40" width="40" viewBox="0 0 48 48"
                    aria-hidden="true">
                    <circle class="circle" fill="#5bb543" cx="24" cy="24" r="22" />
                    <path class="tick" fill="none" stroke="#FFF" stroke-width="6" stroke-linecap="round"
                        stroke-linejoin="round" stroke-miterlimit="10" d="M14 27l5.917 4.917L34 17" />
                </svg>
            </div>
            <span class="voted_msg">You have voted successfully..!</span>
        </div>
        <div class="countdown" id="countdown">Redirecting in 5 seconds...</div>
    </div>
</div>




<script>
// Function to redirect after countdown
function redirect() {
    window.location.href = "<?php echo base_url(); ?>index.php/ml/Home/results";// Change the URL to your desired destination
}

// Countdown function
function countdown() {
    var seconds = 5; // Countdown duration in seconds
    var countdownElement = document.getElementById('countdown');

    var countdownInterval = setInterval(function() {
        seconds--;
        countdownElement.textContent = "Redirecting in " + seconds + " seconds...";

        if (seconds <= 0) {
            clearInterval(countdownInterval);
            redirect(); // Redirect after countdown
        }
    }, 1000); // Update every 1 second
}

// Start the countdown when the page is loaded
countdown();
</script>