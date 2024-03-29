<style>
.profile_cover_photo{
    background: url(<?php echo base_url('assets/images/profile/5.png'); ?>);
    background-size: cover;
    background-position: center;
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo{
        background: url(<?php echo base_url('assets/images/profile/small/5.png'); ?>);
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
                    <div class="profile-photo">   <img src="<?php echo base_url($contestant->photo_url); ?>" class="img-fluid"
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
                    <p class="mb-2" style="text-indend:4px;">Jasmin Jaffar, a renowned social media influencer and
                        YouTuber from Kerala, gained widespread recognition for her participation in Bigg Boss Malayalam
                        Season 6. Standing at approximately 165 centimeters tall (5 feet 5 inches), Jasmin was born on
                        October 25, 2000, in Kollam, Kerala, which makes her 23 years old as of 2023. She holds Indian
                        nationality and practices Islam. Jasmin, who hails from Kollam, Kerala, follows a non-vegetarian
                        diet. She is single and does not have a spouse. Her father, Jaffer, is a fishmonger, and her
                        mother is a homemaker. Jasmin has a brother named Muhammad Jamseer but no sisters.

                    </p>
                </div>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Professional Achievements</h4>
                <ul class="unorder-list ms-5" style="    line-height: 3;">
                    <li>Over 1.14 million subscribers on YouTube.</li>
                    <li>Published nearly 941 videos covering DIY, beauty, fashion, lifestyle, makeup tutorials, reviews,
                        and travel.</li>
                    <li>Provides insights into daily life, humorous scenarios, and thought-provoking discussions.</li>
                    <li>Shares relatable short videos.</li>
                    <li>Explores topics like mental health, depression, suicide, and toxic parenting.</li>
                    <li>Celebrates personal milestones.</li>
                    <li>Highly anticipated performance in Bigg Boss Malayalam Season 6.</li>
                </ul>



            </div>

        </div>
    </div>
</div>