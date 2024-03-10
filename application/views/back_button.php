<style>
    .back_wrapper{
        display: flex;
        align-items: baseline;
    }
    .back_btn{
        margin-right:1em;
        color: #fff;
        cursor:pointer;
    }
    .Result-heading{
        color:#fff;
    }
    @media only screen and (max-width: 767px) {

        .back_wrapper{
            align-items: center;
        }
    }
</style>
<div class="back_wrapper">
    <a class="back_btn" href="javascript:history.back();">
        <span class="material-symbols-outlined">
        keyboard_backspace
        </span>
    </a>
    <h2 class="Result-heading"><?php echo $page_title; ?></h2>
</div>