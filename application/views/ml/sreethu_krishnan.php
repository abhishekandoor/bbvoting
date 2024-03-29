<style>
.profile_cover_photo{
    background: url(<?php echo base_url('assets/images/profile/7.png'); ?>);
    background-size: cover;
    background-position: center;
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo{
        background: url(<?php echo base_url('assets/images/profile/small/7.png'); ?>);
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
                    <p class="mb-2" style="text-indend:4px;">Sreethu Krishnan was born on May 2, 1999, in Ernakulam,
                        Kerala. She completed her schooling at St. Francis Xavier Anglo-Indian Higher Secondary School
                        in Chennai and holds a BA in Economics degree from Ethiraj College for Women, Chennai, while
                        also pursuing her MA in Economics through distance education.
                    </p>
                </div>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Television Career:</h4>
                <ul class="unorder-list ms-5">
                    <li>Sreethu made her debut in the 7C TV series on Vijay TV.</li>
                    <li>Notable roles include Indira in the TV series Aayutha Ezhuthu and Aleena Peter in Ammayariyathe.
                    </li>
                    <li>She has participated in various TV shows, including Super Singer (Season 6), Jodi Fun Unlimited,
                        and Start Music Season 3.</li>
                </ul>



            </div>
            <div class="profile-lang  mb-5">
                <h4 class="text-primary mb-2 ">Filmography:

                </h4>
                <ul class="unorder-list ms-5">>
                    <li>Sreethu ventured into films with the Tamil movie "10 Endrathukulla", where she played James
                        Bond's sister.</li>
                    <li>She also appears in the film "Irulil Ravanan" in a leading role.</li>
                </ul>


            </div>

        </div>
    </div>
</div>