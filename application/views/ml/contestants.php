<?php foreach($contestants as $row){ ?>
<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
    <div class="card  wallet">
        <div class="boxs">
            <span class="box one"></span>
            <span class="box two"></span>
            <span class="box three"></span>
            <span class="box four"></span>
        </div>
        <div class="card-body border-0 pe-5">
            <div class="main-div d-flex align-items-center justify-content-between">
                <div class="left__div">
                    <div class="photo__div text-center">
                        <img src='https://www.indiajobrecruitment.com/wp-content/uploads/2023/07/Akhil-Marar.webp'
                            style="height: 8em;" />
                    </div>
                    <div class="title__div text-center">
                        <div class="name__div">
                                <h4 class="text-white"><?php echo $row['name'] ?></h4>
                        </div>
                        <div class="profession__div text-center">
                            <h5 class="text-white">Actor</h5>
                        </div>
                    </div>
                </div>
                <div class="right__div">
                    <div style="display: flex;
                    flex-direction: column;
                    align-items: center;">
                        <div class="send m-auto bg-white">
                            <a href="#">
                                <img src="<?php echo base_url().'assets/icons/vote2.png'; ?>" style="margin-bottom:5px;"/>
                            </a>
                        </div>
                        <span>Vote</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php } ?>