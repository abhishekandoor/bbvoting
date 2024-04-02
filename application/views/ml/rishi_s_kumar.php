<style>
.profile_cover_photo{
    background: url(<?php echo base_url('assets/images/profile/4.png'); ?>);
    background-size: cover;
    background-position: center;
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo{
        background: url(<?php echo base_url('assets/images/profile/small/4.png'); ?>);
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
                    <p class="mb-2" style="text-indend:4px;">Rishi S. Kumar, born on August 18, 1994, in Kakkanad,
                        Ernakulam, Kerala, India, is a prominent figure on the Malayalam small screen, renowned for his
                        contributions to various television shows and films. He derives support from his father, Sunil
                        Kumar, a businessman, and his mother, Pushpalatha, a homemaker. Rishi has two younger brothers,
                        Rithu and Rishesh, who are currently pursuing their education. The encouragement and backing
                        from his family have been pivotal in shaping Rishi's successful acting career.
                    </p>
                </div>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Film Debut:</h4>
                <ul class="unorder-list ms-5">
                    <li>Pypin Chottile Pranayam: Rishi made his big-screen debut in Neeraj Madhav’s film Pypin Chottile
                        Pranayam, where he played the male lead. This marks his transition from supporting roles to a
                        central character.</li>
                </ul>

            </div>
            <div class="profile-lang  mb-5">
                <h4 class="text-primary mb-2 ">Passion for Dance:

                </h4>
                <ul class="unorder-list ms-5">
                    <li>Rishi’s confidence, happiness, and perfection shine through when he dances. His dream is to
                        travel the world, and he also received an offer for a world tour based on his dance
                        performances.</li>
                </ul>

            </div>

            <div class="profile-lang  mb-5">
                <h4 class="text-primary mb-2">Trademark Hairstyle:

                </h4>
                <ul class="unorder-list ms-5">

                    <li>Rishi’s quirky hairstyle has been a topic of discussion, both positively and negatively. Despite
                        any criticism, he remains true to himself and continues to do what feels best.</li>
                    <li>Even during film auditions, Neeraj Madhav allowed him to keep his distinctive hairstyle intact.
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>