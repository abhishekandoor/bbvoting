<style>
.profile_cover_photo{
    background: url(<?php echo base_url('assets/images/profile/11.png'); ?>);
    background-size: cover;
    background-position: center;
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo{
        background: url(<?php echo base_url('assets/images/profile/small/11.png'); ?>);
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
</>
<div class="card h-auto">
    <div class="card-body">
        <div id="about-me" class="tab-pane fade active show">
            <div class="profile-about-me">
                <div class="pt-4 border-bottom-1 pb-3">
                    <h4 class="text-primary">Personal Life</h4>
                    <p class="mb-2" style="text-indend:4px;">Asi Rocky, also known as Tattoo Boy or Rocco, is a Tattoo
                        Artist and Businessman. His real name is Haseeb SK, and he was born on 22 May 1988 in
                        Thiruvananthapuram, Kerala. As of 2024, he is 36 years old, and Thiruvananthapuram is both his
                        birthplace and hometown. Asi Rocky has a son named Ragnar Rocky, who is a kickboxing champion.
                    </p>
                </div>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Touch of Ink Tattoo Studio:</h4>
                <ul class="unorder-list ms-5">
                    <li>Touch of Ink Tattoo Studio is Asi Rocky's renowned establishment, founded in 2014.</li>
                    <li>It is the first and only certified tattoo institute in Kerala, emphasizing excellence and
                        customer satisfaction.</li>
                    <li>The studio is popular among celebrities and individuals seeking high-quality tattoo services.
                    </li>
                    <li>They prioritize safety by using organic inks for artistic creations.</li>
                </ul>


            </div>

        </div>
    </div>
</div>