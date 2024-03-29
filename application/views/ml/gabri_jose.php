<style>
.profile_cover_photo{
    background: url(<?php echo base_url('assets/images/profile/13.png'); ?>);
    background-size: cover;
    /* background-position: center; */
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo{
        background: url(<?php echo base_url('assets/images/profile/small/13.png'); ?>);
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
                    <p class="mb-2" style="text-indend:4px;">Gabri Jose hails from Angamaly, Kerala, India, and
                        currently resides in Ernakulam, Kerala. He pursued a graduate degree in Civil Engineering and
                        obtained a diploma in Acting from Holy Grace Academy of Engineering, Kerala.

                    </p>
                </div>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Biography of Gabri Jose:


                </h4>
                <ul class="unorder-list ms-5">
                    <li>Gabri Jose is an Indian actor primarily working in the Malayalam film industry.</li>
                    <li>He made his movie debut with "Pranaya Meenukalude Kadal" in 2019.</li>
                    <li>His notable role was in "Thattukada Muthal Semitheri Vare" in 2022.</li>
                    <li>Gabri is a former radio jockey and practices yoga for mental well-being.</li>
                    <li>He has a fondness for animals, especially dogs.</li>
                    <li>His educational background includes a degree in Civil Engineering and a diploma in Acting.</li>
                </ul>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Interesting Facts about Gabri Jose:


                </h4>
                <ul class="unorder-list ms-5">
                    <li>Gabri Jose is a former radio jockey.</li>
                    <li>His acting guru is the veteran actor Anupam Kher.</li>
                    <li>Gabri prioritizes his mental health by practicing yoga regularly.</li>
                    <li>He has a soft spot for animals, particularly dogs.</li>
                </ul>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Filmography

                </h4>
                <ul class="unorder-list ms-5">
                    <li><strong>Pranaya Meenukalude Kadal (2019):</strong> His debut film where he played the role of
                        Ajmal.</li>
                    <li><strong>Thattukada Muthal Semitheri Vare (2022):</strong> Gabri portrayed the character of Jibri
                        in this thriller.</li>
                </ul>
            </div>


        </div>
    </div>
</div>