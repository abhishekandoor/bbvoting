<style>
h1 {
    font-size: 5em;
    font-weight: bolder;
}

h3 {
    font-weight: bold;
    font-size: 1.8em;
}

h4 {
    font-size: 1.5em;
    text-align: center;
}

.site_desc {
    font-size: 1.7em;
    color: yellow;
}

.title {
    font-size: 1.8em;
    font-weight: bold;
}

.description {
    font-size: 1.3em;
}

.main-container {
    min-height: 100vh;
    padding-top: 10em;
}

.second-container,
.third-container {
    min-height: 100vh;

    /* margin-top:12em; */
}

.service_icons {
    font-size: 3.8em;

}

.services {
    width: 50%;
    padding: 40px 20px;
    border: 2px dashed transparent; /* Set a transparent border */
    border-radius: 4px; /* Add border radius */
    transition: border-color 0.3s ease, border-radius 0.3s ease; 
}
.services:hover{
    border-color: #fff; /* Change the border color */
    border-radius: 8px; /* Adjust the border radius */
}

.services div {
    text-align: center;
}

.how_to_points {
    /* color: white !important; */
    font-size: 1.1em;
}

.how_to_vote_icons {
    margin-right: 10px;
}

.vote_icon {
    font-size: 2.2em;
}
.animation-text {
  /* bottom: 60% !important; */
  animation: bottomFadeOut 2s ease-in-out;

}
@keyframes bottomFadeOut {
  0% {
    /* position: absolute; */
    margin-top: 250px ;
    opacity: 0;
  }

  100% {
    /* position: absolute; */
    margin-top: 0rem;
    opacity: 1;
  }
}
@media only screen and (max-width: 767px) {
    /* CSS rules specific to mobile devices go here */
    h1 {
        font-size: 2.5em;
    }
    .site_desc {
        font-size: 1.4em;
    }
    .services {
        width: 100%;
    }
}
</style>
<div class="main-container animation-text">
    <div>
        <h1 class="text-white text-center">BIGG BOSS</h1>
    </div>
    <div>
        <h1 class="text-white text-center">UNOFFICIAL VOTING PLATFORM</h1>
    </div>
    <div>
        <p class="text-center site_desc">Dive into the world of Bigg Boss with our unofficial voting platform and AI-driven
            analytics. Get real-time insights, trends, and predictions about your favorite contestants!
        </p>
    </div>
    <div class="text-center"><a class="btn btn-outline-primary btn-rounded mt-3 px-5"
            href="<?php echo base_url().'index.php/ml/Home' ?>">Malayalam</a></div>
    <div class="text-center"><a class="btn btn-outline-primary btn-rounded mt-3 px-5"
          target="_blank"  href="<?php echo base_url().'contact-us' ?>">Contact - us</a></div>

</div>

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9199579426500892"
     crossorigin="anonymous"></script>
<!-- Ad-1 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-9199579426500892"
     data-ad-slot="6478673005"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

<div class="second-container">
    <div class="row page-titles">
        <div class="card-title text-center ">
            <span class="material-symbols-outlined vote_icon">
                enterprise
            </span>
            <h3 class="text-white"> Our Services</h3>
        </div>
        <div class="services">
            <div><span class="material-symbols-outlined service_icons">robot_2</span></div>
            <div><span class="title">AI-driven Analytics</span></div>
            <div><span class="description">Explore AI-driven analytics on BBVoting.com for cutting-edge insights and
                    predictions on Bigg Boss contestants. Discover the future of voting!</span>
            </div>
        </div>
        <div class="services">
            <div><span class="material-symbols-outlined service_icons">
                    aod_watch
                </span></div>
            <div><span class="title">Real-Time Insights</span></div>
            <div><span class="description">Experience real-time insights on BBVoting.com for instant updates and trends
                    on Bigg Boss contestants. Stay ahead of the game!</span>
            </div>
        </div>
        <div class="services">
            <div><span class="material-symbols-outlined service_icons">
                    trending_up
                </span></div>
            <div><span class="title">Trends</span></div>
            <div><span class="description">Explore trending patterns on BBVoting.com for up-to-date trends and analysis
                    of Bigg Boss contestants. Stay informed, stay ahead</span>
            </div>
        </div>
        <div class="services">
            <div><span class="material-symbols-outlined service_icons">
                    editor_choice
                </span></div>
            <div><span class="title">Predictions</span></div>
            <div><span class="description">Discover champion predictions on BBVoting.com. Our AI analyzes contestant
                    performance to forecast the Bigg Boss winner</span>
            </div>
        </div>
    </div>

</div>

<div class="third-container">
    <div class="row">
        <div class="col-xl-12 col-md-12 ">
            <div class="card">
                <div class="card-body">
                    <div class="card-title text-center ">
                        <span class="material-symbols-outlined vote_icon">
                            how_to_vote
                        </span>
                        <h3 class="text-white"> How to vote ?</h3>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-md-12">
                            <div class="profile-news">
                                <h4 class=" text-white">Official</h4>
                                <div class="media pt-3 pb-3">
                                    <span class="material-symbols-outlined how_to_vote_icons">
                                        kid_star
                                    </span>
                                    <div class="media-body">
                                        <p class="how_to_points mb-0">Download Disney+ Hotstar on your Android or iOS
                                            device.</p>

                                    </div>
                                </div>
                                <div class="media pt-3 pb-3">
                                    <span class="material-symbols-outlined how_to_vote_icons">
                                        kid_star
                                    </span>
                                    <div class="media-body">
                                        <p class="how_to_points mb-0">Sign in or create an account using your Indian
                                            mobile number.
                                        </p>

                                    </div>
                                </div>
                                <div class="media pt-3 pb-3">
                                    <span class="material-symbols-outlined how_to_vote_icons">
                                        kid_star
                                    </span>
                                    <div class="media-body">
                                        <p class="how_to_points mb-0">Look up "Bigg Boss Malayalam" and access its page.
                                        </p>

                                    </div>
                                </div>
                                <div class="media pt-3 pb-3">
                                    <span class="material-symbols-outlined how_to_vote_icons">
                                        kid_star
                                    </span>
                                    <div class="media-body">
                                        <p class="how_to_points mb-0">Tap on the "Vote Now" option to cast your vote for
                                            your preferred contestant between Monday 10:30 PM IST and Friday 11:59 PM
                                            IST.
                                        </p>

                                    </div>
                                </div>
                                <div class="media pt-3 pb-3">
                                    <span class="material-symbols-outlined how_to_vote_icons">
                                        kid_star
                                    </span>
                                    <div class="media-body">
                                        <p class="how_to_points mb-0">You are entitled to one vote daily and up to five
                                            votes per week.
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12">
                            <div class="profile-news">
                                <h4 class=" text-white">Unofficial</h4>
                                <div class="media pt-3 pb-3">
                                    <span class="material-symbols-outlined how_to_vote_icons">
                                        kid_star
                                    </span>
                                    <div class="media-body">
                                        <p class="how_to_points mb-0">You can bookmark this page and come back every day to vote.
                                        </p>
                                    </div>
                                </div>
                                <div class="media pt-3 pb-3"><span class="material-symbols-outlined how_to_vote_icons">
                                        kid_star
                                    </span>
                                    <div class="media-body">
                                        <p class="how_to_points mb-0">or search “Bigg Boss Malayalam Voting” on Google and click on this website’s link which is <a href="https://bbvoting.com">bbvoting.com</a> from the results
                                        </p>
                                    </div>
                                </div>
                                <div class="media pt-3 pb-3">
                                    <span class="material-symbols-outlined how_to_vote_icons">
                                        kid_star
                                    </span>
                                    <div class="media-body">
                                        <p class="how_to_points mb-0">We can guarantee that the votes you see on this website will almost be equal to the official Hotstar voting trends. No more fake voting counts, modifications, etc. like other unofficial polls.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9199579426500892"
     crossorigin="anonymous"></script>
<ins class="adsbygoogle"
     style="display:block; text-align:center;"
     data-ad-layout="in-article"
     data-ad-format="fluid"
     data-ad-client="ca-pub-9199579426500892"
     data-ad-slot="5392822043"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>