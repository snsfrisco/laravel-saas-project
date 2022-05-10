<style>
    #side_popup_div {
        position: fixed;
        right: 0;
        width: 60%;
        max-width: 60%;
        height: 95vh;
        max-height: 95vh;
        background-color: #fff;
        z-index: 6;
        box-shadow: -5px 0px 5px #484848;
        overflow: scroll;
        padding: 10px;
        display: none;
    }

    #side_popup_overlay {
        position: fixed;
        display: none;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0,0,0,0.5);
        z-index: 2;
        cursor: pointer;
    }
</style>
<div id="side_popup_overlay"></div>
<div id="side_popup_div">
    <p id="close_side_popup_div" class="px-3"><i class="fa fa-times" style="cursor:pointer;"></i></p>
    <div id="side_popup_div_content" class="px-3"></div>
</div>
<script>
    function side_popup_on() {
        document.getElementById("side_popup_overlay").style.display = "block";
    }
    function side_popup_off() {
        document.getElementById("side_popup_overlay").style.display = "none";
    }
</script>
