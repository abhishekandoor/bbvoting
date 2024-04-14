<style>
.profile_cover_photo {
    background: url(<?php echo base_url('assets/images/profile/25.png');
    ?>);
    background-size: cover;
    
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo {
        background: url(<?php echo base_url('assets/images/profile/small/25.png');
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
                        <img src="<?php echo base_url('uploads/sibin.png'); ?>" class="img-fluid" alt="">
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
                    <p class="mb-2" style="text-indend:4px;">DJ Sibin Benjamin, born in Thiruvananthapuram, Kerala,
                        India, hails from the same city and follows Christianity. He attended Holy Trinity English
                        Medium Higher Secondary School in Thiruvananthapuram and later pursued his studies at the
                        University of Kerala. As of the available information, he is unmarried and has two brothers
                        named Benson Benjamin and Baiju Soloman.
                    </p>
                </div>
            </div>
            <div class="profile-skills mb-3">
                <h4 class="text-primary mb-2">Background and Passion for Music:</h4>
                <ul class="unorder-list ms-5">
                    <li>DJ Sibin Benjamin is a prominent figure in the music scene, known for his unique sound and
                        energetic performances. </li>
                    <li>Her notable film roles include "Drishyam" (Anju George), "Uthara
                        The Brain" (CBI Officer Anitha), "Kurukkan" (Anjitha), "Drishyam</li>
                </ul>



            </div>
            <div class="profile-lang  mb-3">
                <h4 class="text-primary mb-2 ">Career Journey and Signature Style: </h4>
                <ul class="unorder-list ms-5">
                    <li> Sibin gained recognition by performing at college fests and club nights, showcasing his ability
                        to seamlessly blend various music genres.
                    </li>
                    <li> Known for dynamic sets fusing EDM, house, and techno, Sibin creates an electrifying atmosphere
                        with his infectious energy on stage.
                    </li>
                </ul>
            </div>

            <div class="profile-lang  mb-3">
                <h4 class="text-primary mb-2">Challenges, Popularity, and Legacy:</h4>
                <ul class="unorder-list ms-5">
                    <li> Despite facing challenges in balancing fame and artistic growth, Sibin's determination and
                        passion for music kept him motivated.
                    </li>
                    <li> His popularity soared, attracting both admiration and criticism, especially facing criticism
                        from fans of an ex-contestant named Robin.</li>
                    <li>DJ Sibin Benjamin continues to be an influential figure, inspiring aspiring DJs with his
                        journey, emphasizing that passion and persistence lead to remarkable achievements.</li>
                </ul>
            </div>
        </div>
    </div>
</div>