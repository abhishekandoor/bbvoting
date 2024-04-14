<style>
.profile_cover_photo {
    background: url(<?php echo base_url('assets/images/profile/21.png');
    ?>);
    background-size: cover;
    
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo {
        background: url(<?php echo base_url('assets/images/profile/small/21.png');
        ?>);
        background-size: cover;
        
    }
}
</style>
<?php $this->load->view('back_button'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="profile card card-body px-3 pt-3 pb-0">
            <div class="profile-head">
                <div class="photo-content" ,>
                    <div class="profile_cover_photo">

                    </div>
                </div>
                <div class="profile-info">
                    <div class="profile-photo">
                        <img src="<?php echo base_url('uploads/abhishek_s.png'); ?>" class="img-fluid" alt="">
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
                    <p class="mb-2" style="text-indend:4px;">Abhishek sreekumar, born in Kerala, India in 1996.He is
                        28-year-old . with a BTech degree in Mechanical Engineering. He
                        comes from a family with two sisters.
                    </p>
                </div>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Profession:</h4>
                <ul class="unorder-list ms-5">
                    <li>Business man </li>
                    <li> Model </li>
                    <li>Actor
                    </li>
                    <li>Social media influencer</li>
                </ul>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Controversy:</h4>
                <ul class="unorder-list ms-5">
                    <li>Involved in controversy due to strong anti-LGBTQ views, leading to social media account
                        suspensions.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>