<style>


.profile_cover_photo{
    background: url(<?php echo base_url('assets/images/profile/3.jpg'); ?>);
    background-size: cover;
    background-position: center;
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo{
        background: url(<?php echo base_url('assets/images/profile/small/3.jpg'); ?>);
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
                    <p class="mb-2" style="text-indend:4px;">Yamuna Rani, originally from Pattathanam in Kollam, was
                        born in Arunachal Pradesh
                        and adopted the name ‘Yamuna’ upon entering the small screen, replacing her original name,
                        ‘Aruna’; her father, Venugopalan Nair, worked as a PWD Engineer in Arunachal Pradesh, while her
                        mother, Shathamma, dedicated herself to homemaking, and she has a younger sister who is five
                        years her junior.





                    </p>
                </div>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Career Highlights</h4>
                <ul class="unorder-list ms-5">
                    <li>Yamuna Rani is a renowned actress in the Malayalam Film and Television industry.</li>
                    <li>She began her acting journey with the telefilm series ‘Basheer Kathakal’, directed by PN Menon.
                    </li>
                    <li>Her performance in the television serial ‘Jwalayay’ received significant acclaim.</li>
                    <li>She has also played supporting roles in films such as ‘Ustad,’ ‘Valyettan,’ ‘Pattanathil
                        Sundaran,’ and ‘Meesamadhavan.’</li>
                </ul>

            </div>
            <div class="profile-lang  mb-5">
                <h4 class="text-primary mb-2">Artistic Journey:

                </h4>
                <ul class="unorder-list ms-5">
                    <li>Yamuna Rani started her artistic journey with the telefilm series “Basheer Kathakal” directed by
                        PN Menon.</li>
                    <li>After three years as an associate with PN Menon, she transitioned to a lead role in the
                        Malayalam serial “Manasi” before achieving a breakthrough in her career with the serial
                        “Jwalayay.”</li>
                    <li>She gained popularity for her role as Madhumathy in the serial “Chandanamazha.”</li>
                </ul>


            </div>

            <div class="profile-lang  mb-5">
                <h4 class="text-primary mb-2">Film Career:

                </h4>
                <ul class="unorder-list ms-5">
                    <li>Yamuna Rani made her silver screen debut in the 1999 film “Stalin Sivadas.”</li>
                    <li>She has delivered exceptional performances in over 45 movies, including “Ustad,” “Valyettan,”
                        “Pattanathil Sundaran,” and “Meesamadhavan.”</li>
                    <li>Her most recent appearance was in the Mohanlal-starrer “Ittymani Made in China.”</li>
                </ul>



            </div>
        </div>
    </div>
</div>