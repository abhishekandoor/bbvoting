<style>
.profile_cover_photo{
    background: url(<?php echo base_url('assets/images/profile/15.png'); ?>);
    background-size: cover;
    /* background-position: center; */
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo{
        background: url(<?php echo base_url('assets/images/profile/small/15.png'); ?>);
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
                    <p class="mb-2" style="text-indend:4px;">Arjun Syam Gopan, whose full name is Arjun Syam Gopan
                        Kottayam, is also known by the nickname Appu. He is a model, actor, and TV personality hailing
                        from Kochi, Kerala, India. Arjun was born on March 20, 1997, in Kottayam, Kerala, making him 27
                        years old as of 2024. He is of Indian nationality.

                    </p>
                </div>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Modeling and Mr. Kerala Title:

                </h4>
                <ul class="unorder-list ms-5">
                    <li>Arjun Syam Gopan is a prominent figure in the modeling industry, having earned the esteemed
                        title of Mr. Kerala.</li>
                    <li>His relentless dedication and hard work have not only solidified his position as a full-time
                        model but also enabled him to represent Kerala at national-level judo competitions.</li>
                </ul>



            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Real Men Awards Recognition:

                </h4>
                <ul class="unorder-list ms-5">
                    <li>Arjun Syam Gopan was recognized as the winner of the #RealMenAwards for November.</li>
                    <li>His story serves as an inspiration, highlighting the power of determination and self-belief.
                    </li>
                </ul>



            </div>

        </div>
    </div>
</div>