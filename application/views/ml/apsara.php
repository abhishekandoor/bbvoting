<style>
.profile_cover_photo{
    background: url(<?php echo base_url('assets/images/profile/12.png'); ?>);
    background-size: cover;
    background-position: center;
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo{
        background: url(<?php echo base_url('assets/images/profile/small/12.png'); ?>);
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
                    <p class="mb-2" style="text-indend:4px;">Apsara Ratnakaran, born on June 19, 1995, in
                        Thiruvananthapuram, Kerala, India, completed her education at Sky High School Nanniyode before
                        pursuing further studies at Mahatma Gandhi University. Known for her cute and charming
                        appearance, Apsara endeared herself to audiences early on. Her passion for acting and modeling
                        drove her to begin her career in both fields while still studying, leading to early success.


                    </p>
                </div>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Career Highlights</h4>
                <ul class="unorder-list ms-5">
                    <li>Apsara Rathnakaran embarked on her acting and modeling career while still pursuing her
                        education, achieving early success.</li>
                    <li>She has appeared in numerous Tamil television shows, leaving a lasting impact with her acting
                        prowess.</li>
                    <li>Over time, she has embraced roles in both Malayalam and Tamil languages, showcasing her
                        versatility as an actress.</li>
                </ul>


            </div>
            <div class="profile-lang  mb-5">
                <h4 class="text-primary mb-2">Notable Roles:

                </h4>
                <ul class="unorder-list ms-5">
                    <li>Apsara gained acclaim for her portrayal in the Malayalam serial “Santhwanam” (2020), adapted
                        from the popular Tamil series “Pandian Stores”.</li>
                    <li>Her performances across various TV shows have garnered admiration from fans and industry
                        insiders alike.</li>
                </ul>



            </div>

            <div class="profile-lang  mb-5">
                <h4 class="text-primary mb-2">Appearance:



                </h4>
                <ul class="unorder-list ms-5">
                    <li>Apsara possesses an appealing and bright countenance.</li>
                    <li>Her captivating smile and beautiful eyes contribute to her overall charm.</li>
                    <li>Her long black hair adds to her allure.</li>
                </ul>



            </div>
        </div>
    </div>
</div>