<style>



.profile_cover_photo{
    background: url(<?php echo base_url('assets/images/profile/2.jpg'); ?>);
    background-size: cover;
    background-position: center;
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo{
        background: url(<?php echo base_url('assets/images/profile/small/2.jpg'); ?>);
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
            
                        <img src="<?php echo base_url('uploads/jinto.jpg'); ?>" class="img-fluid"
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
                    <p class="mb-2" style="text-indend:4px;">Jinto P.D. was born on 17 January in Kalady, Kerala, and is
                        of Indian nationality. His hometown is also Kalady. He has siblings, including a brother (name
                        not known) and a younger sister named Jisha.

                    </p>
                </div>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Career Highlights:


                </h4>
                <ul class="unorder-list">
                    <li>Received the Mother Teresa Award in 2022</li>
                    <li>Won the Best Celebrity Personal Trainer Award in 2023</li>
                    <li>Internationally recognized as a bodybuilder, model, and fitness trainer</li>
                    <li>Established Jinto BodyCraft as a leading fitness center in Trivandrum</li>
                    <li>Notable for training celebrities and IPS level officers</li>
                </ul>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">The Artistry Behind the Brush:

                </h4>
                <ul class="unorder-list ms-5">
                    <li>Jinto BodyCraft has become the best gym in Trivandrum under his leadership, setting new industry
                        standards..</li>
                </ul>
            </div>


        </div>
    </div>
</div>