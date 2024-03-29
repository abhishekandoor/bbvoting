<style>
.profile_cover_photo{
    background: url(<?php echo base_url('assets/images/profile/17.png'); ?>);
    background-size: cover;
    /* background-position: center; */
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo{
        background: url(<?php echo base_url('assets/images/profile/small/17.png'); ?>);
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
                    <p class="mb-2" style="text-indend:4px;">Saranya Anand was born on December 10 in Surat, Gujarat,
                        and grew up in Adoor, Pathanamthitta, Kerala. She attended St. Thomas English Medium Higher
                        Secondary School in Kerala and later pursued a Bachelor of Science in Nursing from Mangalore
                        University, Karnataka. Saranya’s sister, Divya (Divyadarshana Anand), won the title of Miss
                        Kerala 2020. Her marriage to entrepreneur Manesh Rajan Nair was arranged through mutual family
                        friends, and they tied the knot on November 4, 2020, at Guruvayoor Temple in Kerala.

                    </p>
                </div>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Career Highlights</h4>
                <ul class="unorder-list ms-5">
                    <li>Saranya gained prominence for her roles in Malayalam films such as “Thanaha” (2018), “Mamangam”
                        (2019), and “Aakasha Ganga 2” (2019).</li>
                    <li>She also portrayed the negative role of Vedhika in the Malayalam television show
                        “Kudumbavilakku” (2020) on Asianet.</li>
                </ul>



            </div>
            <div class="profile-lang  mb-5">
                <h4 class="text-primary mb-2">Award and Recognitions:

                </h4>
                <ul class="unorder-list ms-5">
                    <li>Best Upcoming Actress in Cinema at the Malabar Film Society Award Nights (2018)</li>
                    <li>Youth Icon Award for “Akasha Ganga 2” (2020)</li>
                    <li>Best Negative Role Award for her portrayal of Vedika in “Kudumbavilakku” (2022)</li>
                    <li>Honored as the “Style Diva in Malayalam Television Industry” by The Times of India in October
                        2021</li>
                    <li>Golden Buzzer Couple of Dancing Stars (2022) alongside her husband, Manesh Rajan Nair</li>
                </ul>




            </div>

            <div class="profile-lang  mb-5">
                <h4 class="text-primary mb-2">Fun Facts:
                </h4>
                <ul class="unorder-list ms-5">
                    <li>Saranya Anand started her modeling career in class 10, appearing in a TV advertisement for
                        Mahindra Scorpio.</li>
                    <li>She enjoys reading and dancing as hobbies.</li>
                </ul>




            </div>
        </div>
    </div>
</div>