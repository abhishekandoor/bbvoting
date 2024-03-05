<?php foreach($contestants as $row){ ?>
<div class="col-xl-4 col-lg-5 col-md-12 col-sm-12">
    <div class="card  wallet">
        <div class="boxs">
            <span class="box one"></span>
            <span class="box two"></span>
            <span class="box three"></span>
            <span class="box four"></span>
        </div>
        <div class="card-header border-0 pe-5">
            <div class="photo_div" >
                <img src='https://www.indiajobrecruitment.com/wp-content/uploads/2023/07/Akhil-Marar.webp' style="height: 13em;"/>
            </div>
            <div>
                <div class=" m-auto">
                    <!-- <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="1"
                            d="M15.1667 4.66667C15.1667 4.02233 14.6444 3.5 14 3.5C13.3557 3.5 12.8334 4.02233 12.8334 4.66667V18.6667C12.8334 19.311 13.3557 19.8333 14 19.8333C14.6444 19.8333 15.1667 19.311 15.1667 18.6667V4.66667Z"
                            fill="white" />
                        <path
                            d="M7.825 12.4916C7.36939 12.9472 6.63069 12.9472 6.17508 12.4916C5.71947 12.036 5.71947 11.2973 6.17508 10.8417L13.1751 3.84171C13.6168 3.40003 14.3279 3.38458 14.7884 3.80665L21.7884 10.2233C22.2634 10.6587 22.2954 11.3967 21.8601 11.8717C21.4247 12.3467 20.6867 12.3787 20.2117 11.9433L14.0351 6.2815L7.825 12.4916Z"
                            fill="white" />
                        <path opacity="1"
                            d="M23.3333 22.1667H4.66667C4.02233 22.1667 3.5 22.689 3.5 23.3334C3.5 23.9777 4.02233 24.5 4.66667 24.5H23.3333C23.9777 24.5 24.5 23.9777 24.5 23.3334C24.5 22.689 23.9777 22.1667 23.3333 22.1667Z"
                            fill="white" />
                    </svg> -->
                </div>
                <!-- <span>Transfer </span> -->
            </div>

        </div>
        <div class="card-body py-3  d-flex align-items-center justify-content-between flex-wrap">
            <div class="wallet-info">
                <!-- <span class="fs-18 d-block">Wallet Balance</span> -->
                <h4 class="font-w600 mb-0 d-inline-flex me-2 text-break"><?php echo $row['name']; ?></h4>
                <!-- <span>+0.8% than last week</span> -->
            </div>
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
<?php } ?>