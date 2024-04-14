<style>
.profile_cover_photo {
    background: url(<?php echo base_url('assets/images/profile/24.png');
    ?>);
    background-size: cover;
    
    min-height: 20rem;
    width: 100%;
}
@media only screen and (max-width: 767px) {
    .profile_cover_photo {
        background: url(<?php echo base_url('assets/images/profile/small/24.png');
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
                        <img src="<?php echo base_url('uploads/sai.png'); ?>" class="img-fluid" alt="">
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
                    <p class="mb-2" style="text-indend:4px;">Sai Krishna, also known as Secret Agent, was born in
                        Malappuram, Kerala, in the year 1993. As of 2024, he is 31 years old. He is married to Sneha R
                        Nair, who is also a digital creator, and he has a sister.

                    </p>
                </div>
            </div>
            <div class="profile-lang mb-5">
    <h4 class="text-primary mb-2">Early Life and Beginnings:</h4>
    <ul class="unorder-list ms-5">
        <li>Born with a natural curiosity and passion for technology.</li>
        <li>Embarked on the content creation journey to simplify complex tech concepts.</li>
    </ul>
</div>

<div class="profile-lang mb-5">
    <h4 class="text-primary mb-2">Exploring the Secret Agent Identity:</h4>
    <ul class="unorder-list ms-5">
        <li>Adopted the Secret Agent moniker to add an element of mystery and intrigue.</li>
        <li>Gained attention for a unique mix of humor, wit, and technical expertise.</li>
    </ul>
</div>

<div class="profile-lang mb-5">
    <h4 class="text-primary mb-2">YouTube Journey:</h4>
    <ul class="unorder-list ms-5">
        <li>Became a hub for tech enthusiasts with a diverse range of content:</li>
        <ul class="unorder-list ms-5">
            <li>Reviewed gadgets from smartphones to smart home devices.</li>
            <li>Provided step-by-step tutorials for tech setups and troubleshooting.</li>
            <li>Offered behind-the-scenes insights into tech events and creative processes.</li>
            <li>Explored unconventional experiments and challenges in tech.</li>
        </ul>
        <li>Popularized the sign-off catchphrase, "This is Secret Agent, signing off!"</li>
    </ul>
</div>

<div class="profile-lang mb-5">
    <h4 class="text-primary mb-2">Fostering a Tech Community:</h4>
    <ul class="unorder-list ms-5">
        <li>Established the KIC Community, a digital hub for tech enthusiasts.</li>
        <li>Encouraged a sense of belonging and curiosity among viewers.</li>
    </ul>
</div>

<div class="profile-lang mb-5">
    <h4 class="text-primary mb-2">Innovator and Trailblazer:</h4>
    <ul class="unorder-list ms-5">
        <li>Extended influence beyond YouTube to social media and tech forums.</li>
        <li>Set high standards for authenticity, transparency, and top-notch content.</li>
    </ul>
</div>

<div class="profile-lang mb-5">
    <h4 class="text-primary mb-2">Legacy and Inspiration:</h4>
    <ul class="unorder-list ms-5">
        <li>Continues to inspire millions as a tech-savvy leader.</li>
        <li>Embodies the power of passion and perseverance in unraveling the digital realm.</li>
    </ul>
</div>

         

            
        </div>
    </div>
</div>