<style>
.profile_cover_photo{
    background: url(<?php echo base_url('assets/images/profile/19.png'); ?>);
    background-size: cover;
    background-position: center;
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo{
        background: url(<?php echo base_url('assets/images/profile/small/19.png'); ?>);
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
                    <p class="mb-2" style="text-indend:4px;">Nishana Nihal, a vibrant homemaker and commoner contestant
                        in Bigg Boss Malayalam Season 6, was born on 25 November in Palakkad, Kerala. She is of Indian
                        nationality, follows Islam, and resides at CVM House, Puthuppariyaram, Palakkad, Kerala. Nishana
                        got married on 7 February 2010 and has three children, including two sons and one daughter.
                    </p>
                </div>
                <div class="profile-skills mb-5">
                    <h4 class="text-primary mb-2">Travel Journey</h4>
                    <ul class="unorder-list ms-5" style="    line-height: 3;">

                        <li>Embarked on solo adventures to unexplored destinations in India and Nepal as a travel
                            enthusiast.</li>
                        <li>Documented her experiences as a vlogger on her streaming channel, sharing explorations with
                            a wider audience.</li>
                        <li>Shifted towards organizing small group tours to popular tourist spots across India,
                            showcasing an entrepreneurial spirit.</li>
                        <li>Committed to creating memorable travel experiences for others.</li>
                    </ul>
                </div>
            </div>
    </div>
    </div>
</div>