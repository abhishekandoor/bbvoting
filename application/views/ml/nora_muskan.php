<style>
.profile_cover_photo{
    background: url(<?php echo base_url('assets/images/profile/14.png'); ?>);
    background-size: cover;
    /* background-position: center; */
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo{
        background: url(<?php echo base_url('assets/images/profile/small/14.png'); ?>);
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
                    <p class="mb-2" style="text-indend:4px;"> Nora Muskan, whose original name is Shaibal Sadath, was
                        born on December 3, 1998, in Kozhikode, Kerala. He is 25 years old as of 2023 and follows Islam
                        as his religion.

                    </p>
                </div>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Education:


                </h4>
                <ul class="unorder-list ms-5">
                    <li>Government Higher Secondary School in Kuttikkattoor, Kozhikode</li>
                    <li>Government Model Higher Secondary School in Kozhikode</li>
                    <li>Dayapuram Arts and Science College for Women in Kattangal, Kerala</li>
                </ul>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Social Media Presence of Norah Muskaan:
                </h4>

                <ul class="unorder-list ms-5">
                    <li>Norah Muskaan is a video streamer with an Instagram account.</li>
                    <li>She can also be found on Facebook and Gaana.</li>
                </ul>
            </div>


        </div>
    </div>
</div>