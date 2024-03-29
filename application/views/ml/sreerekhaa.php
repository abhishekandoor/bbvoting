<style>
.profile_cover_photo{
    background: url(<?php echo base_url('assets/images/profile/10.png'); ?>);
    background-size: cover;
    background-position: center;
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo{
        background: url(<?php echo base_url('assets/images/profile/small/10.png'); ?>);
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
                    <p class="mb-2" style="text-indend:4px;">Sreerekha Rajagopal, also known as Srirekha, Sreerekhaa,
                        and Sri Rekha, is a multi-talented individual with professions in acting, psychology, and social
                        media influencing. She has dark brown eyes and black hair with dark brown highlights, hailing
                        from Thrissur, Kerala, and holding Indian nationality. Sreerekha completed her graduation in
                        Psychology and has a hobby of dancing. She is married to Sandeep Sreedharan, also known as
                        Chandhu Orange, who is a filmmaker, and they have a son and a daughter. Sreerekha's mother is
                        Smt. S. Girijakumari, a retired Senior Deputy Chief Accountant of the Cochin Port Trust, while
                        her father's name is not known.

                    </p>
                </div>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Career Highlights:

                </h4>
                <ul class="unorder-list ms-5">
                    <li>Sreerekha Rajagopal made her debut in the Malayalam film industry with "Veyil" in 2022,
                        portraying the character Radha.</li>
                    <li>She received the Kerala State Film Award for Best Character Actress in 2021.</li>
                    <li>Sreerekha was felicitated by the Cochin Port Authority and received the All Kerala Shane Nigam
                        Fans & Welfare Association Award in the same year.</li>
                </ul>



            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Family Details:

                </h4>
                <ul class="unorder-list ms-5">
                    <li>Husband: Sandeep Sreedharan (Chandhu Orange), a filmmaker</li>
                    <li>Children: Son and Daughter</li>
                    <li>Parents:
                        <ul>
                            <li>Father's Name: Not Known</li>
                            <li>Mother: Smt. S. Girijakumari, retired Senior Deputy Chief Accountant of Cochin Port
                                Trust</li>
                        </ul>
                    </li>
                </ul>



            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Career Path and Achievements:

                </h4>
                <ul class="unorder-list ms-5">
                    <li>Made debut in Malayalam film industry with "Veyil" in 2022, portraying the character Radha</li>
                    <li>Received Kerala State Film Award for Best Character Actress in 2021</li>
                    <li>Felicitated by the Cochin Port Authority</li>
                    <li>Received the All Kerala Shane Nigam Fans & Welfare Association Award in 2021</li>
                </ul>

            </div>

        </div>
    </div>
</div>