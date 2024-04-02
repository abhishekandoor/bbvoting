<style>
.profile_cover_photo{
    background: url(<?php echo base_url('assets/images/profile/1.png'); ?>);
    background-size: cover;
    background-position: center;
    min-height: 20rem;
    width: 100%;
}


@media only screen and (max-width: 767px) {
    .profile_cover_photo{
        background: url(<?php echo base_url('assets/images/profile/small/1.png'); ?>);
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
                <div class="photo-content",>
                    <div class="profile_cover_photo">

                    </div>
                </div>
                <div class="profile-info">
                    <div class="profile-photo">
                        <img src="<?php echo base_url('uploads/ansiba.jpg'); ?>" class="img-fluid"
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
                    <p class="mb-2" style="text-indend:4px;">Ansiba Hassan, a versatile personality in the South Indian
                        entertainment industry, is known for her roles as a model, dancer, TV anchor, and film actress
                        hailing from Kerala. Her journey began as a TV presenter, eventually leading her into the world
                        of cinema. Born on June 18, 1992, in Calicut, Kerala, Ansiba is the eldest among her siblings,
                        which include three younger brothers named Asib, Ashiq, and Afzal, along with a younger sister
                        named Afsana. Her father, Hassan, works as a photographer, while her mother, Rasiya Hassan, is a
                        homemaker. Ansiba pursued her passion for communication by completing her graduation in Visual
                        Communication.
                    </p>
                </div>
            </div>
            <div class="profile-skills mb-5">
                <h4 class="text-primary mb-2">Film Career Highlights</h4>
                <ul class="unorder-list ms-5">
                    <li>Ansiba debuted as a TV presenter before venturing into the Tamil and Malayalam film industry.
                    </li>
                    <li>Her notable film roles include "Drishyam" (Anju George), "Uthara Chemmeen" (Neelipennu), "CBI 5:
                        The Brain" (CBI Officer Anitha), "Kurukkan" (Anjitha), "Drishyam 2" (Anju George), "Badarul
                        Muneer Husnul Jamal Sulekha", and "Zebra Varakal" (Mary Cherian).</li>
                </ul>



            </div>
            <div class="profile-lang  mb-5">
                <h4 class="text-primary mb-2 ">Notable Roles:

                </h4>
                <ul class="unorder-list ms-5">
                    <li>“Drishyam”: Anju George (Malayalam)</li>
                    <li>“Uthara Chemmeen”: Neelipennu (Malayalam)</li>
                    <li>“CBI 5: The Brain”: CBI Officer Anitha (Malayalam)</li>
                    <li>“Kurukkan”: Anjitha (Malayalam)</li>
                    <li>“Drishyam 2”: Anju George (Malayalam) – Sequel to “Drishyam”</li>
                    <li>“Badarul Muneer Husnul Jamal Sulekha” (Malayalam)</li>
                    <li>“Zebra Varakal”: Mary Cherian (Malayalam)</li>
                </ul>




            </div>

            <div class="profile-lang  mb-5">
                <h4 class="text-primary mb-2">Television Career Highlights:



                </h4>
                <ul class="unorder-list ms-5">
                    <li>“Ente Kuttikkalam”: Presenter (Kochu TV)</li>
                    <li>“Comedy Super Night 2”: Host (Flowers TV)</li>
                    <li>“Marhaba”: Anchor (Flowers TV)</li>
                    <li>“Sell Me the Answer”: Participant (Asianet)</li>
                    <li>“Lalettanodoppam”: Host (kaumudy TV)</li>
                    <li>“Onam Samam Payasam”: Presenter (kaumudy TV)</li>
                </ul>




            </div>
        </div>
    </div>
</div>