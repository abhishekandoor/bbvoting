<style>
.profile_cover_photo {
    background: url(<?php echo base_url('assets/images/profile/22.png');
    ?>);
    background-size: cover;

    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo {
        background: url(<?php echo base_url('assets/images/profile/small/22.png');
        ?>);
        background-size: cover;
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
                        <img src="<?php echo base_url('uploads/pooja.png'); ?>" class="img-fluid" alt="">
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
                    <p class="mb-2" style="text-indend:4px;">Pooja Krishna was born on 20 July 2000 (Thursday) in
                        Thrissur, Kerala. As of 2023, she is 23 years old. Her hometown is also in Thrissur, Kerala. She
                        attended Sreekrishna Higher Secondary School in Guruvayur, Kerala, and later studied at St.
                        Thomas College in Thrissur, Kerala. </p>
                </div>
            </div>
            <div class="profile-skills mb-3">
                <h4 class="text-primary mb-2">Anchor and Host Career Highlights</h4>
                <ul class="unorder-list ms-5">
                    <li>She has worked as an anchor on YouTube channels such as Variety Media, Jango Space, and
                        Behindwoods. </li>
                </ul>
            </div>
            <div class="profile-lang  mb-3">
                <h4 class="text-primary mb-2 ">Film Ventures:
                </h4>
                <ul class="unorder-list ms-5">
                    <li>Appeared in short films and feature films like “Rekha,” showcasing versatility as an artist and
                        creating memorable moments on screen.</li>
                </ul>
            </div>
            <div class="profile-lang  mb-3">
                <h4 class="text-primary mb-2">Television Highlights:
                </h4>
                <ul class="unorder-list ms-5">
                    <li>Participated as a contestant on D4Dance MMTV in 2013.</li>
                    <li>Acted in the popular show “Thatteem Mutteem” in 2020, displaying acting skills alongside
                        anchoring talents.</li>
                </ul>
            </div>
            <div class="profile-lang  mb-3">
                <h4 class="text-primary mb-2">Continuing Narrative:
                </h4>
                <ul class="unorder-list ms-5">
                    <li>Pooja Krishna's career as an anchor and host continues to evolve, driven by a passion for
                        storytelling and creativity.
                    </li>


                </ul>




            </div>
        </div>
    </div>
</div>