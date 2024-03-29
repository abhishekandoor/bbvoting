<style>
.profile_cover_photo{
    background: url(<?php echo base_url('assets/images/profile/16.jpg'); ?>);
    background-size: cover;
    /* background-position: center; */
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo{
        background: url(<?php echo base_url('assets/images/profile/small/16.jpg'); ?>);
        background-size: cover;
        background-position: center;
    }
}

</style>
<?php $this->load->view('back_button'); ?>


<div class="row">
    <div class="col-lg-12">
        <div class="profile card card-body px-3 pt-3 pb-0">
            <div class="profile-head">
                <div class="photo-content">
                    <div class="profile_cover_photo"></div>
                </div>
                <div class="profile-info">
                    <div class="profile-photo">
                    <img src="<?php echo base_url($contestant->photo_url); ?>" class="img-fluid"
                            alt="">
                    </div>
                    <div class="profile-details">
                    <div class="profile-name px-3 pt-2">
                            <h4 class="text-white mb-0"></h4><?php 
                            
                             echo $contestant->name; 
                            
                            ?>
                            <p><?php  
                            echo $contestant->profession;?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card h-auto">
    <div class="card-body">
        <div id="about-me" class="tab-pane fade active show">
            <div class="profile-about-me">
                <div class="pt-4 border-bottom-1 pb-3">
                    <h4 class="text-primary">Personal Life</h4>
                    <p class="mb-2" style="text-indend:4px;">Suresh Menon, the actor, was born on 10 January 1967 in
                        Palakkad, Kerala, India. He follows Hinduism and hails from Palakkad, Kerala. In his personal
                        life, Suresh Menon is married to Shurobi Menon. They have two sons, and information about his
                        daughter is not available. Initially, Suresh Menon pursued a career in journalism before
                        venturing into the entertainment industry.
                    </p>
                </div>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Filmography of Suresh Menon:</h4>
                <ul class="unorder-list ms-5">
                    <li>Grand Masti</li>
                    <li>Phir Hera Pheri</li>
                    <li>Partner</li>
                    <li>Fool N Final</li>
                    <li>Krazzy 4</li>
                    <li>Deewane Huye Pagal</li>
                    <li>Chalte Chalte</li>
                    <li>God Only Knows</li>
                    <li>Dil To Pagal Hai</li>
                    <li>Hello</li>
                    <li>And many more!</li>
                </ul>

            </div>
            <div class="profile-lang  mb-5">
                <h4 class="text-primary mb-2 ">Television Appearances of Suresh Menon:

                </h4>
                <ul class="unorder-list ms-5">
                    <li>Participated in the reality show Jhalak Dikhhla Jaa.</li>
                    <li>Served as a judge on the game show Hello Kaun? Pehchaan Kaun alongside Chunky Pandey.</li>
                    <li>Hosted several radio shows.</li>
                    <li>Featured in the Amazon Prime Video show Jestination Unknown.</li>
                </ul>

            </div>

            <div class="profile-lang  mb-5">
                <h4 class="text-primary mb-2">Entrepreneurial Ventures of Suresh Menon:

                </h4>
                <ul class="unorder-list ms-5">

                    <li>Suresh Menon is the co-founder of ONE (One Entertainment Networks), which curates and produces
                        content across digital platforms.</li>
                </ul>

            </div>
            <div class="profile-lang  mb-5">
                <h4 class="text-primary mb-2">Podcast and Radio Hosting by Suresh Menon:

                </h4>
                <ul class="unorder-list ms-5">

                    <li>Co-hosts the podcast Kaanmasti with VJ Jose and Cyril d’Abreo.</li>
                </ul>

            </div>
        </div>
    </div>
</div>