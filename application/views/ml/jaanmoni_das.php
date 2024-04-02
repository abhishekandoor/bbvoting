<style>
.profile_cover_photo{
    background: url(<?php echo base_url('assets/images/profile/8.png'); ?>);
    background-size: cover;
    /* background-position: center; */
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo{
        background: url(<?php echo base_url('assets/images/profile/small/8.png'); ?>);
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
                    <p class="mb-2" style="text-indend:4px;">Jaanmoni Das, the esteemed make-up artist, was born in
                        Guwahati, Assam, to a railway employee father and a homemaker mother. Her upbringing in a family
                        with a rich artistic heritage, including renowned figures like singing legend Bhupendra Hazarika
                        and film directors, instilled in her a deep appreciation for the arts from an early age.

                    </p>
                </div>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">The Make-Up Artist Emerges:

                </h4>
                <ul class="unorder-list ms-5">
                    <li>Discovered her love for make-up and realized it was her true calling.
                    </li>
                    <li>Established herself as one of Kerala's most sought-after make-up artists with a successful
                        career.
                    </li>
                </ul>



            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">The Artistry Behind the Brush:

                </h4>
                <ul class="unorder-list ms-5">
                    <li>Jaanmoni humbly acknowledges her friends and co-workers as her best critics.</li>
                    <li>Her strokes transform faces, enhancing beauty and confidence.</li>
                    <li>Celebrities like Ranjini Haridas and Amala Paul have never complained about her work.</li>
                    <li>Jaanmoni is an ardent fan of Bollywood star Sridevi, and her dream is to be Sridevi’s personal
                        make-up artist.</li>
                    <li>Sridevi’s expressive eyes continue to inspire Jaanmoni.</li>
                </ul>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">A Decade of Excellence:

                </h4>
                <ul class="unorder-list ms-5">
                    <li>Jaanmoni recently celebrated a decade in the Malayalam movie industry.</li>
                    <li>She marked this milestone with a grand party, launching a celebrity calendar and a bridal studio
                        in Kochi.</li>
                    <li>Her journey from Assam to becoming Kerala’s “queen of make-up” is a testament to her passion,
                        talent, and unwavering dedication.</li>
                </ul>

            </div>

        </div>
    </div>
</div>