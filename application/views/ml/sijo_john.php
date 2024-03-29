<style>
.profile_cover_photo{
    background: url(<?php echo base_url('assets/images/profile/6.png'); ?>);
    background-size: cover;
    /* background-position: center; */
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo{
        background: url(<?php echo base_url('assets/images/profile/small/6.png'); ?>);
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
                    <p class="mb-2" style="text-indend:4px;">Sijotalks, known by the nickname Sijotalks, is a YouTuber
                        and model. She was born on 14 July 1991 (Sunday) in Alappuzha, Kerala. As of 2023, she is 32
                        years old. Sijotalks' hometown is also Alappuzha. She completed her education at KUCTE, Aryad,
                        in 2018, obtaining a B.Ed in Mathematics.
                    </p>
                </div>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Background:</h4>
                <ul class="unorder-list ms-5">
                    <li>Sijo hails from Alappuzha, a picturesque town in Kerala, India.</li>
                    <li>His content reflects his unique perspective and experiences.</li>
                </ul>
            </div>
            <div class="profile-lang  mb-5">
                <h4 class="text-primary mb-2 ">Influence:

                </h4>
                <ul class="unorder-list ms-5">
                    <li>Sijo is part of a growing community of Malayali vloggers and influencers who are making their
                        mark on social media platforms.</li>
                    <li>Sijo runs a YouTube channel called “Sijo Talks”.</li>
                </ul>

            </div>


        </div>
    </div>
</div>