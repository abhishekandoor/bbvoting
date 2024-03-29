<style>
.profile_cover_photo{
    background: url(<?php echo base_url('assets/images/profile/9.jpg'); ?>);
    background-size: cover;
    background-position: center;
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo{
        background: url(<?php echo base_url('assets/images/profile/small/9.jpg'); ?>);
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
                    <p class="mb-2" style="text-indend:4px;">Ratheesh Kumar, born on November 14, 1982, is 42 years old.
                        He is a singer and runs the "Pallavi School of Music and Dance." His wife is a dancer, and
                        together they manage the school.
                    </p>
                </div>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Profession:</h4>
                <ul class="unorder-list ms-5">
                    <li>Singer</li>
                    <li>Runs “Pallavi School of Music and Dance”</li>
                </ul>

            </div>
            <div class="profile-lang  mb-5">
                <h4 class="text-primary mb-2 "> Notable Fact:

                </h4>
                <ul class="unorder-list ms-5">
                    <li>Established himself as a singer through intense interest, passion, and hard work</li>
                </ul>

            </div>

        </div>
    </div>
</div>