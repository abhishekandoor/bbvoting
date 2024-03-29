<style>
.profile_cover_photo{
    background: url(<?php echo base_url('assets/images/profile/18.png'); ?>);
    background-size: cover;
    background-position: center;
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo{
        background: url(<?php echo base_url('assets/images/profile/small/18.png'); ?>);
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
                    <p class="mb-2" style="text-indend:4px;">
                        A. R. Resmin Bai, an Indian national born on 3 July 1995 in Kochi, Kerala, holds a master’s
                        degree in physical education and is a literature graduate. She works as a dedicated physical
                        education teacher at one of Kerala's popular colleges, actively participates in cultural
                        activities, and is known for her love for bikes, anchoring experience, and involvement as a sea
                        cadet. In her personal life, Resmin is non-vegetarian, enjoys dancing and anchoring as hobbies,
                        is unmarried, and has a tattoo with the phrase 'Miles to go' on her left arm. She has a brother
                        named Razeem Kochi and a sister named Rehana Bai, while her parents' names remain undisclosed.
                    </p>
                </div>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Professional Information:</h4>
                <ul class="unorder-list ms-5">
                    <li>Occupation: Physical education teacher at a popular college in Kerala</li>
                    <li>Bike Enthusiast: Passionate about bikes and riding</li>
                    <li>Anchoring Experience: Hosted Onam special segment with TV couple Sneha and Sreekumar</li>
                    <li>Sea Cadet: Volunteer for activities at Kochi Naval Base</li>
                    <li>Previous TV Appearance: Contestant on 'Udan Panam'</li>
                    <li>Educational Background: Master’s degree in physical education and literature graduate</li>
                </ul>


            </div>



        </div>
    </div>
</div>