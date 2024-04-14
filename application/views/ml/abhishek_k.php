<style>
.profile_cover_photo {
    background: url(<?php echo base_url('assets/images/profile/20.png');
    ?>);
    background-size: cover;
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo {
        background: url(<?php echo base_url('assets/images/profile/small/20.png');
        ?>);
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
                <div class="photo-content" ,>
                    <div class="profile_cover_photo">

                    </div>
                </div>
                <div class="profile-info">
                    <div class="profile-photo">
                        <img src="<?php echo base_url('uploads/abhishek_k.png'); ?>" class="img-fluid" alt="">
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
                    <p class="mb-2" style="text-indend:4px;">Abhishek K Jayadeep, also known as Abishek K Jayadeep with
                        the nickname Abee, was born on December 7, 1997, in Thrissur, Kerala, India. He is currently 26
                        years old and holds Indian nationality, originating from Thrissur. Abhishek is unmarried and
                        resides in Pune. He is the son of Jayadeep Kattungal and has a sister named Pooja K Jayadeep.
                    </p>
                </div>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Early Life and Education:</h4>
                <ul class="unorder-list ms-5">
                    <li>Completed Bachelor of Technology (BTech) in Computer Science from Vidya Academy of Science &
                        Technology, Technical Campus (VAST TC), Kilimanoor, during 2016-2020.</li>
                    <li>Actively participated in coding competitions and hackathons during college.</li>
                </ul>




            </div>
            <div class="profile-lang  mb-5">
                <h4 class="text-primary mb-2 ">Advocacy Work:

                </h4>
                <ul class="unorder-list ms-5">
                    <li>Faced societal stigma and discrimination but remained resilient in advocating for equal rights.
                    </li>
                    <li>Inspired many within the LGBTQ community to embrace their identities without fear.</li>
                </ul>






            </div>

            <div class="profile-lang  mb-5">
                <h4 class="text-primary mb-2">Beyond Titles:</h4>
                <ul class="unorder-list ms-5">
                    <li>Active participant in pride marches, speaker at events, and community engagements.</li>
                    <li>Goal is to create a more accepting world for everyone to live authentically.</li>
                </ul>





            </div>
        </div>
    </div>
</div>